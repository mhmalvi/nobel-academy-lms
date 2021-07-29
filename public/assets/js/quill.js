var toolbarOptions = [
    ["bold", "italic", "underline"],
    [{ list: "bullet" }, "link"],
    [{ color: [] }],
];

var quill = new Quill("#editor", {
    theme: "snow",
    modules: {
        toolbar: toolbarOptions,
    },
    placeholder: "Announce something to your class",
});

quill.insertText(0, "Hello", "bold", true);

var delta = quill.getContents();

console.log(JSON.stringify(delta));
