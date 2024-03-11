document.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll(".reply-link").forEach(function (replyLink) {
    replyLink.addEventListener("click", function (e) {
      e.preventDefault();
      var commentElement = this.closest(".comment");
      var mainCommentElement = commentElement.closest(".children")
        ? commentElement.parentElement.closest(".comment")
        : commentElement;
      var respondSection =
        mainCommentElement.getElementsByClassName("comment-respond")[0];
      var respondingToField =
        respondSection.getElementsByClassName("responding-to")[0];
      var commentId = this.getAttribute("data-commentid");
      var replyTo = this.getAttribute("data-replyto") || "Autor desconhecido";

      respondSection.style.display = "block";

      respondingToField.value = commentId;

      var replyTitle = respondSection
        .getElementsByClassName("comment-title")[0]
        .getElementsByClassName("reply-title")[0];

      replyTitle.textContent = "Responder para " + replyTo;

      var children = commentElement.getElementsByClassName("children")[0];

      if (children) {
        children.style.display = "block";
      }

      var hiddenField = document.getElementById("respondingTo");
      hiddenField.value = replyTo;
    });
  });

  document
    .querySelectorAll("#cancel-response")
    .forEach(function (cancelResponseLink) {
      cancelResponseLink.addEventListener("click", function (e) {
        e.preventDefault();
        var commentElement = this.closest(".comment");
        var mainCommentElement = commentElement.closest(".children")
          ? commentElement.parentElement.closest(".comment")
          : commentElement;
        var respondSection =
          mainCommentElement.getElementsByClassName("comment-respond")[0];
        respondSection.style.display = "none";

        var children = commentElement.getElementsByClassName("children")[0];
        children.style.display = "none";
      });
    });
});
