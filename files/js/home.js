let currentPage = "";
showPage("stellingen");

if (document.getElementById('button-stellingen')) {
    document.querySelector('#button-stellingen').addEventListener('click', () => {
        showPage("stellingen");
    })
}

if (document.getElementById('button-partijen')) {
    document.querySelector('#button-partijen').addEventListener('click', () => {
        showPage("partijen");
    })
}

function showPage(page, questionID = null) {
    if (currentPage !== page) {
        let request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                document.getElementById("content-container").innerHTML = this.response;

                if (page === "stellingen") {
                    document.getElementById("button-partijen").classList.remove('active');
                    document.getElementById("button-"+page).classList.add('active');

                    getStellingen();
                } else if (page === "partijen") {
                    document.getElementById("button-stellingen").classList.remove('active');
                    document.getElementById("button-"+page).classList.add('active');

                    getPartijen();
                } else if (page === "stelling-add" || page === "stelling-edit") {
                    document.getElementById("button-stellingen").classList.remove('active');
                    document.getElementById("button-partijen").classList.remove('active');
                    getStellingenPartijen(page, questionID);
                } else {
                    document.getElementById("button-stellingen").classList.remove('active');
                    document.getElementById("button-partijen").classList.remove('active');
                    assignButtonFunctions();
                }

                currentPage = page;


            }
        }
        request.open("GET", "/files/views/" + page + ".php", true);
        request.send();
    }
}

function assignButtonFunctions() {

    if (document.getElementsByClassName("editEntry")[0]) {
        document.querySelectorAll('.editEntry').forEach((element) => {
            element.addEventListener('click', () => {
                editEntry(element);
            })
        });
    }

    if (document.getElementsByClassName("deleteEntry")[0]) {
        document.querySelectorAll('.deleteEntry').forEach((element) => {
            element.addEventListener('click', () => {
                deleteEntry(element);
            })
        });
    }

    if (document.getElementById('button-add-stelling')) {
        document.querySelector('#button-add-stelling').addEventListener('click', () => {
            showPage("stelling-add");
        });
    }

    if (document.getElementById('button-add-partij')) {
        document.querySelector('#button-add-partij').addEventListener('click', () => {
            showPage("partij-add");
        });
    }

    if (document.getElementById('button-save-stelling')) {
        document.querySelector('#button-save-stelling').addEventListener('click', () => {
            saveEntry(document.getElementById('button-save-stelling'));
        });
    }

    if (document.getElementById('button-save-partij')) {
        document.querySelector('#button-save-partij').addEventListener('click', () => {
            saveEntry(document.getElementById('button-save-partij'));
        });
    }

    if (document.getElementById('button-update-stelling')) {
        document.querySelector('#button-update-stelling').addEventListener('click', () => {
            updateEntry(document.getElementById('button-update-stelling'));
        });
    }

    if (document.getElementById('button-update-partij')) {
        document.querySelector('#button-update-partij').addEventListener('click', () => {
            updateEntry(document.getElementById('button-update-partij'));
        });
    }

    if (document.getElementById('button-cancel-stelling')) {
        document.querySelector('#button-cancel-stelling').addEventListener('click', () => {
            showPage("stellingen");
        });
    }

    if (document.getElementById('button-cancel-partij')) {
        document.querySelector('#button-cancel-partij').addEventListener('click', () => {
            showPage("partijen");
        });
    }
}

function getStellingen() {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("stellingen-table-content").innerHTML = this.response;
            assignButtonFunctions();
        }
    }
    request.open("GET", "/files/includes/stellingen-list.php", true);
    request.send();
}

function getPartijen() {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("partijen-table-content").innerHTML = this.response;
            assignButtonFunctions();
        }
    }
    request.open("GET", "/files/includes/partijen-list.php", true);
    request.send();
}

function getStellingenPartijen(page, questionID) {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("partijen-radios").innerHTML = this.response;

            if (page === "stelling-edit") {
                enableCheckboxes(questionID);
            }

            assignButtonFunctions();
        }
    }
    request.open("GET", "/files/includes/stellingen-partijen-list.php", true);
    request.send();
}

function enableCheckboxes(questionID) {
    let data = "stelling-partijen="+questionID;

    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

            let checkboxes = document.getElementsByClassName('partij-keuze-checkbox');

            let result = JSON.parse(this.response);
            for (let i = 0; i < result.length; i++) {
                for (let j = 0; j < checkboxes.length; j++) {
                    if (result[i] === checkboxes[j].value) {
                        checkboxes[j].checked = true;
                    }
                }
            }
        }
    }
    request.open("POST", "/files/requests/edit.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);
}

function saveEntry(element) {
    let type = element.getAttribute('data-type');

    switch (type) {
        case "question":
            let form = document.getElementById('stelling-add-form');
            let request1 = new XMLHttpRequest();

            request1.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    showPage('stellingen');
                }
            }

            request1.open('POST', '/files/requests/add.php');
            request1.send(new FormData(form));
            break;
        case "party":
            let pName = document.getElementById('naam').value;
            let pShort = document.getElementById('afkorting').value;

            let data = "add="+type+"&name="+pName+"&short="+pShort;

            let request2 = new XMLHttpRequest();
            request2.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    showPage("partijen");
                }
            }
            request2.open("POST", "/files/requests/add.php", true);
            request2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request2.send(data);

            break;
    }
}

function editEntry(element) {
    let type = element.getAttribute('data-type');
    let entry = element.getAttribute('data-entry');

    switch (type) {
        case "question":
            showPage("stelling-edit", entry);

            let data1 = "edit="+type+"&eid="+entry;

            let request1 = new XMLHttpRequest();
            request1.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    let result1 = JSON.parse(this.response);
                    document.getElementById('subject').value = result1[1];
                    document.getElementById('question').value = result1[2];
                    document.getElementById('eid').value = result1[0];
                }
            }
            request1.open("POST", "/files/requests/edit.php", true);
            request1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request1.send(data1);
            break;
        case "party":
            showPage("partij-edit");


            let data = "edit="+type+"&eid="+entry;

            let request= new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    let result = JSON.parse(this.response);

                    document.getElementById('naam').value = result[1];
                    document.getElementById('afkorting').value = result[2];
                    document.getElementById('eid').value = result[0];
                }
            }
            request.open("POST", "/files/requests/edit.php", true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.send(data);
            break;
    }
}

function updateEntry(element) {
    let type = element.getAttribute('data-type');

    switch (type) {
        case "question":

            break;
        case "party":

            let pUid = document.getElementById('eid').value;
            let pName = document.getElementById('naam').value;
            let pShort = document.getElementById('afkorting').value;

            let data = "update="+type+"&uid="+pUid+"&name="+pName+"&short="+pShort;

            let request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    showPage("partijen");
                }
            }
            request.open("POST", "/files/requests/edit.php", true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.send(data);

            break;
    }
}

function deleteEntry(element) {
    console.log('delete');
    console.log(element.getAttribute('data-entry'));
    console.log(element.getAttribute('data-type'));

    let type = element.getAttribute('data-type');
    let entry = element.getAttribute('data-entry');
    let data = "delete="+type+"&did="+entry;

    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            if (request.response === "true") {
                element.closest('.table-entry').remove();
            } else {
                console.log("error deleting " + type + " " + entry);
            }
        }
    }
    request.open("POST", "/files/requests/delete.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);
}