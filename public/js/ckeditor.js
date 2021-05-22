// On initialise CKEditor
BalloonEditor
.create(
    document.querySelector("#editor"))
.then(editor => {
    editor.sourceElement.parentElement.addEventListener("submit", function(e){
        e.preventDefault();
        this.querySelector("#editor + input").value = editor.getData();
        this.submit();
    })
});