<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight" data-i18n-app="contactAdminTitle">
            Contacter Admin
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white dark:bg-[var(--app-surface)] shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-[var(--app-border)] overflow-hidden">
                <div class="h-1.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                <div class="p-6 sm:p-8">
                    @if (session('success'))
                        <div class="mb-6 rounded-lg border border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900/20 p-4 text-green-700 dark:text-green-400 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-lg border border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/20 p-4 text-red-700 dark:text-red-400">
                            <p class="font-semibold mb-2 text-sm" data-i18n-app="errorsHeading">Erreurs :</p>
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
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5" data-i18n-app="proEmailLabel">Email</label>
                            <input
                                type="email"
                                name="email_professionnel"
                                value="{{ old('email_professionnel', $fromEmail) }}"
                                readonly
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-[var(--app-surface-soft)] text-gray-700 dark:text-gray-300 px-4 py-2.5 text-sm"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5" data-i18n-app="subjectLabel">Sujet</label>
                            <input
                                type="text"
                                name="subject"
                                value="{{ old('subject') }}"
                                placeholder="Ex: Demande modification emploi"
                                data-i18n-app-placeholder="subjectPlaceholder"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[var(--app-surface-soft)] text-gray-900 dark:text-gray-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5" data-i18n-app="messageLabel">Message</label>
                            <textarea
                                name="message"
                                rows="6"
                                placeholder="Ecrire votre message pour l'admin..."
                                data-i18n-app-placeholder="messagePlaceholder"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-[var(--app-surface-soft)] text-gray-900 dark:text-gray-100 px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-y min-h-[140px]"
                                required
                            >{{ old('message') }}</textarea>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-sm transition">
                                <span data-i18n-app="sendToAdminBtn">Envoyer à Admin</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
