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
                } else if (page === "partijen") {
                    document.getElementById("button-stellingen").classList.remove('active');
                    document.getElementById("button-"+page).classList.add('active');
                } else {
                    document.getElementById("button-stellingen").classList.remove('active');
                    document.getElementById("button-partijen").classList.remove('active');
                }

                currentPage = page;

                assignButtonFunctions();
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
                editEntry();
            })
        });
    }

    if (document.getElementsByClassName("deleteTest")[0]) {
        document.querySelectorAll('.deleteTest').forEach((element) => {
            element.addEventListener('click', () => {
                deleteEntry();
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
            showPage("partij    -add");
        });
    }
}

function editEntry() {
    console.log('edit');
}

function deleteEntry() {
    console.log('delete');
}