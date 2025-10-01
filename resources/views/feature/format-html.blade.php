<x-app-layout>
<div class="p-6 bg-white rounded-lg shadow space-y-4">
  <!-- Input -->
  <div>
    <label for="html-input" class="block mb-2 text-gray-900 text-2xl font-bold">
      Format HTML
    </label>
    <textarea id="html-input" rows="10"
      class="block p-2.5 w-full text-sm font-mono text-gray-900 bg-gray-50 rounded-lg border border-gray-300
             focus:ring-blue-500 focus:border-blue-500
            "
      placeholder="Paste HTML here..."></textarea>
  </div>

  <!-- Options + Format button -->
  <div class="flex items-center gap-2">
    <!-- Indent -->
    <select id="indent-size"
      class="rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
      <option value="2">Indent: 2 spaces</option>
      <option value="4">Indent: 4 spaces</option>
    </select>

    <!-- Info -->
    <p id="type"
       class=" border border-gray-300 px-4 py-2 rounded-lg text-sm font-bold text-blue-600 bg-gray-50">
      Type: HTML
    </p>

    <!-- Format button -->
    <button type="button" id="format-html"
      class="px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 rounded-lg
             focus:ring-2 focus:ring-green-300 focus:outline-none">
      Format
    </button>
  </div>

  <!-- Output + Copy -->
  <div class="relative">
    <div id="html-output"
         class="w-full h-96 overflow-auto bg-gray-100 border border-gray-300 rounded-lg p-3 font-mono text-sm"></div>

    <!-- Copy button -->
    <button id="copy-html"
      class="absolute top-2 right-2 px-3 py-1 text-xs text-white bg-blue-600 hover:bg-blue-700 rounded-md">
      Copy
    </button>
  </div>
</div>

<!-- js-beautify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-beautify/1.14.9/beautify-html.min.js"></script>
<script>
document.getElementById("format-html").addEventListener("click", () => {
    let html = document.getElementById("html-input").value.trim();
    let indent = parseInt(document.getElementById("indent-size").value);

    try {
        // format bằng js-beautify
        let formatted = html_beautify(html, {
            indent_size: indent,
            wrap_line_length: 120,
            preserve_newlines: true
        });

        // hiển thị kết quả (escape < > để không render)
        document.getElementById("html-output").innerHTML =
            "<pre>" + formatted.replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre>";

        // lưu tạm để copy
        document.getElementById("copy-html").dataset.clipboard = formatted;
    } catch (err) {
        alert("Error formatting HTML: " + err.message);
    }
});

// Copy to clipboard
document.getElementById("copy-html").addEventListener("click", () => {
    let text = document.getElementById("copy-html").dataset.clipboard || "";
    navigator.clipboard.writeText(text).then(() => {
        alert("✅ Copied to clipboard!");
    }).catch(err => {
        alert("❌ Failed to copy: " + err);
    });
});
</script>
</x-app-layout>
