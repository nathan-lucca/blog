document.addEventListener("DOMContentLoaded", function () {
  var searchIcon = document.getElementById("searchIcon");
  var searchForm = document.getElementById("searchForm");

  searchIcon.addEventListener("click", function (event) {
    event.stopPropagation();

    if (searchForm.style.visibility === "hidden") {
      searchForm.style.visibility = "visible";
      searchForm.style.opacity = "1";
      searchForm.style.maxHeight = "100px";
    }
  });

  document.addEventListener("click", function (event) {
    if (
      event.target !== searchIcon &&
      event.target !== searchForm &&
      !searchForm.contains(event.target)
    ) {
      searchForm.style.maxHeight = "0";
      searchForm.style.opacity = "0";

      setTimeout(function () {
        searchForm.style.visibility = "hidden";
      }, 500);
    }
  });
});
