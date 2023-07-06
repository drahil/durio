<x-layout>
    <body class="bg-white font-sans">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold mb-6">Give Feedback</h1>
            <form action="/reservations/feedback" method="POST">
                @csrf

                <div class="mb-6">
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                    <label name=""for="body" class="block text-gray-700 font-bold mb-2">Your Feedback</label>
                    <textarea id="body" name="body" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required></textarea>
                </div>
                <div class="mb-6">
                    <label for="rating" class="block text-gray-700 font-bold mb-2">Rating</label>
                    <select id="rating" name="rating" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                        <option value="1">1 - Poor</option>
                        <option value="2">2 - Fair</option>
                        <option value="3">3 - Average</option>
                        <option value="4">4 - Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Submit Feedback</button>
                </div>
            </form>
        </div>
    </div>
    </body>
</x-layout>
