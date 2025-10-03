<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">My Note</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow space-y-4">
        <textarea id="note-content" rows="15"
                  class="w-full border rounded p-3 font-mono text-gray-900 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                  placeholder="Write your note...">{{ $note->content ?? '' }}</textarea>
        <p id="status" class="text-xs text-gray-500"></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        let timer;

        $("#note-content").on("input", function () {
            clearTimeout(timer);
            let content = $(this).val();

            $("#status").text("Saving...");

            // Delay 1s sau khi user ngừng gõ mới save
            timer = setTimeout(() => {
                $.ajax({
                    url: "{{ route('notes.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: content
                    },
                    success: function () {
                        $("#status").text("Saved at " + new Date().toLocaleTimeString());
                    },
                    error: function () {
                        $("#status").text("❌ Error saving note!");
                    }
                });
            }, 1000);
        });
    </script>
</x-app-layout>
