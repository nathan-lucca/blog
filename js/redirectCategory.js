function redirectCategory() {
  const selectedCategoryId = document.querySelector(".select-categoria").value;

  if (selectedCategoryId !== "0") {
    document.getElementById("categorySelectForm").action =
      "category.php?id=" + selectedCategoryId;
    document.getElementById("categorySelectForm").submit();
  }
}
