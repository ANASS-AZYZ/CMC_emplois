<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" data-i18n-app="contactAdminTitle">
            Contacter Admin
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                @if (session('success'))
                    <div class="mb-6 rounded-md border border-green-200 bg-green-50 p-4 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-red-700">
                        <p class="font-semibold mb-2" data-i18n-app="errorsHeading">Kaynin akhta2:</p>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('formateur.contact-admin.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" data-i18n-app="proEmailLabel">Email Professionnel</label>
                        <input
                            type="email"
                            name="email_professionnel"
                            value="{{ old('email_professionnel', $fromEmail) }}"
                            readonly
                            class="w-full rounded-md border-gray-300 bg-gray-100 text-gray-700"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" data-i18n-app="subjectLabel">Sujet</label>
                        <input
                            type="text"
                            name="subject"
                            value="{{ old('subject') }}"
                            placeholder="Ex: Demande modification emploi"
                            data-i18n-app-placeholder="subjectPlaceholder"
                            class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" data-i18n-app="messageLabel">Message</label>
                        <textarea
                            name="message"
                            rows="8"
                            placeholder="Ecrire votre message pour l'admin..."
                            data-i18n-app-placeholder="messagePlaceholder"
                            class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            required
                        >{{ old('message') }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded-lg shadow">
                            <span data-i18n-app="sendToAdminBtn">Envoyer a Admin</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
