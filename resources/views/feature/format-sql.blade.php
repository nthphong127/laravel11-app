

<x-app-layout>
    <div class="p-6 bg-white rounded-lg shadow space-y-4">
        <!-- Input -->
        <div>
            <label for="sql-input" class="block mb-2  text-gray-900 text-2xl font-bold ">
                Format SQL
            </label>
            <textarea id="sql-input" rows="10"
                class="block p-2.5 w-full text-sm font-mono text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                   focus:ring-blue-500 focus:border-blue-500
                  "
                placeholder="Paste SQL here..."></textarea>
        </div>

        <!-- Select dialect + format button -->
        <div class="flex items-center gap-2">
            <!-- Dialect -->
            <select id="sql-dialect" class="rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="sql">Generic SQL</option>
                <option value="mysql">MySQL</option>
                <option value="postgresql">PostgreSQL</option>
                <option value="sqlserver">SQL Server</option>
                <option value="db2">DB2</option>
                <option value="plsql">PL/SQL</option>
            </select>

            <!-- Query type -->
            <p id="type"
                class=" border border-gray-300 px-4 py-2 rounded-lg text-sm font-bold text-red-600 bg-gray-50">
                Type:
            </p>

            <!-- Format button -->
            <button type="button" id="format-sql"
                class="px-4 py-2 text-sm text-white bg-green-600 hover:bg-green-700 rounded-lg
               focus:ring-2 focus:ring-green-300
               focus:outline-none w-1/4">
                Format
            </button>
        </div>


        <!-- Output -->
        <div id="sql-output"
            class="w-full h-96 overflow-auto bg-gray-100 border border-gray-300 rounded-lg p-3 font-mono text-sm"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sql-formatter@15.4.2/dist/sql-formatter.min.js"></script>
    <script>
        document.getElementById("format-sql").addEventListener("click", () => {
            let sql = document.getElementById("sql-input").value.trim();
            let dialect = document.getElementById("sql-dialect").value;

            try {
                let formatted = window.sqlFormatter.format(sql, {
                    language: dialect,
                    keywordCase: "upper"
                });

                // Highlight từ khoá nguy hiểm
                let highlighted = formatted.replace(/\b(UPDATE|DELETE|INSERT|SELECT)\b/g,
                    '<span class="text-red-600 font-bold text-xl">$1</span>');

                document.getElementById("sql-output").innerHTML = "<pre>" + highlighted + "</pre>";

                // 🔍 Kiểm tra tất cả loại SQL có trong string
                let types = [];
                if (/\bSELECT\b/i.test(sql)) types.push("SELECT");
                if (/\bUPDATE\b/i.test(sql)) types.push("UPDATE");
                if (/\bINSERT\b/i.test(sql)) types.push("INSERT");
                if (/\bDELETE\b/i.test(sql)) types.push("DELETE");

                // Nếu không có loại nào
                if (types.length === 0) types.push("UNKNOWN");

                document.getElementById("type").textContent = "Type(s): " + types.join(", ");

            } catch (err) {
                alert("Error formatting SQL: " + err.message);
            }
        });
    </script>
</x-app-layout>
