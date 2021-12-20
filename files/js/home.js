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

function showPage(page) {
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

function saveEntry(element) {
    let type = element.getAttribute('data-type');

    switch (type) {
        case "question":

            break;
        case "party":
            let pName = document.getElementById('naam').value;
            let pShort = document.getElementById('afkorting').value;

            let data = "add="+type+"&name="+pName+"&short="+pShort;

            let request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    showPage("partijen");
                }
            }
            request.open("POST", "/files/requests/add.php", true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.send(data);

            break;
    }
}

function editEntry(element) {
    let type = element.getAttribute('data-type');
    let entry = element.getAttribute('data-entry');

    switch (type) {
        case "question":
            showPage("stelling-edit");
            break;
        case "party":
            showPage("partij-edit");
            break;
    }

    let data = "edit="+type+"&eid="+entry;

    let request= new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let result = JSON.parse(this.response);
            switch (type) {
                case "question":
                    document.getElementById('onderwerp').value = "";
                    document.getElementById('stelling').value = "";
                    document.getElementById('eid').value = result[0];
                    break;
                case "party":
                    document.getElementById('naam').value = result[1];
                    document.getElementById('afkorting').value = result[2];
                    document.getElementById('eid').value = result[0];
                    break;
            }
        }
    }
    request.open("POST", "/files/requests/edit.php", true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);
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