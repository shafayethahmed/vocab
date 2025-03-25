$(document).ready(function() {
    var rowsPerPage = 10; 
    var rows = $(".data-row");
    var totalRows = rows.length;
    var totalPages = Math.ceil(totalRows / rowsPerPage);
    var currentPage = 1;
    var filteredRows = rows; 

    function showPage(page) {
        rows.hide(); 
        filteredRows.hide(); 
        var start = (page - 1) * rowsPerPage;
        var end = start + rowsPerPage;
        filteredRows.slice(start, end).show(); 
        $("#page-numbers").html("Page " + page + " of " + totalPages);
        
        $("#prev-page").prop("disabled", page === 1);
        $("#next-page").prop("disabled", page === totalPages);
    }

    $("#prev-page").click(function() {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    $("#next-page").click(function() {
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    showPage(currentPage);

    //Working with Search box:
    $("#searchbar").on("keyup", function() {
        var searchText = $(this).val().toLowerCase();
        
        if (searchText === "") {
            filteredRows = rows;  //if box empty then show all.
        } else {
            filteredRows = rows.filter(function() {
                return $(this).find("td:nth-child(2)").text().toLowerCase().includes(searchText);
            });
        }

        totalRows = filteredRows.length;
        totalPages = Math.ceil(totalRows / rowsPerPage) || 1; // যদি 0 হয়, তাহলে 1 ধরবে
        currentPage = 1; 
        showPage(currentPage);
    });  
 });
    

     //This is For side Bar toogle
 document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.dropdown-toggle').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            let parent = this.parentElement;
            parent.classList.toggle('active');
            
            document.querySelectorAll('.dropdown').forEach(other => {
                if (other !== parent) {
                    other.classList.remove('active');
                }
            });
        });
    });
});


 //Working with URL Cutter.
      //Cut the URL last part in status 
      document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            const url = new URL(window.location);
            if (url.searchParams.has('status')) { 
                url.searchParams.delete('status'); // "status" URL removes
                window.history.replaceState({}, document.title, url); // URL update
            }
        }, 4000); //Change After 4 sec.
    });
      
    //Team management JS 
    //This is for team management:
        // Function to open modal
        function openModal(id) { document.getElementById(id).classList.add('active'); }

        // Function to close modal
        function closeModal(id) { document.getElementById(id).classList.remove('active'); }

        // Function to search table
        function searchTable() {
            let input = document.getElementById("search").value.toLowerCase();
            let rows = document.getElementById("employeeTable").rows;
            for (let i = 1; i < rows.length; i++) {
                rows[i].style.display = rows[i].cells[1].innerText.toLowerCase().includes(input) ? "" : "none";
            }
        }
        // Function to edit employee
        function editEmployee(id) {
            let row = document.getElementById("employeeTable").rows[id];
            document.getElementById("editEmpId").value = id;
            document.getElementById("editEmpName").value = row.cells[1].innerText;
            document.getElementById("editEmpEmail").value = row.cells[2].innerText;
            document.getElementById("editEmpRole").value = row.cells[3].innerText;
            openModal("editEmployeeModal");
        }

