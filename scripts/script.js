AOS.init();

/*
document.getElementById('form').addEventListener("click", function() {
    alert("Êtes-vous sûr de valider, assurez vous que les informations saisies sont correctes.");
})
    */
   var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});