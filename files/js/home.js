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

    if (document.getElementsByClassName("editTest")[0]) {
        document.querySelectorAll('.editTest').forEach((element) => {
            element.addEventListener('click', () => {
                editEntry(element);
            })
        });
    }

    if (document.getElementsByClassName("deleteTest")[0]) {
        document.querySelectorAll('.deleteTest').forEach((element) => {
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

function editEntry(element) {

    showPage("stelling-edit");

    console.log('edit');
    console.log(element.getAttribute('data-entry'));
    console.log(element.getAttribute('data-type'));
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