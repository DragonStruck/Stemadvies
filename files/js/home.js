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
                } else if (page === "partijen") {
                    document.getElementById("button-stellingen").classList.remove('active');
                }

                document.getElementById("button-"+page).classList.add('active');
                currentPage = page;

                assignButtonFunctions();
            }
        }
        request.open("GET", "/files/views/" + page + ".php", true);
        request.send();
    }
}

function assignButtonFunctions() {
    document.querySelectorAll('.editTest').forEach((element) => {
        element.addEventListener('click', () => {
            editEntry();
        })
    });
    document.querySelectorAll('.deleteTest').forEach((element) => {
        element.addEventListener('click', () => {
            deleteEntry();
        })
    });
}

function editEntry() {
    console.log('edit');
}

function deleteEntry() {
    console.log('delete');
}