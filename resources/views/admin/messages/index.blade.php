<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" data-i18n-app="messagesTrainersTitle">Messages Formateurs</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center gap-3">
                <a href="{{ route('admin.messages.index', ['tab' => 'inbox']) }}"
                   class="px-4 py-2 rounded-md border text-sm font-semibold {{ $tab === 'inbox' ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700 border-gray-300' }}">
                    <span data-i18n-app="inboxTab">Boite de reception</span> ({{ $inboxCount }})
                </a>
                <a href="{{ route('admin.messages.index', ['tab' => 'archive']) }}"
                   class="px-4 py-2 rounded-md border text-sm font-semibold {{ $tab === 'archive' ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700 border-gray-300' }}">
                    <span data-i18n-app="archiveTab">Archive</span> ({{ $archiveCount }})
                </a>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                @if ($messages->isEmpty())
                    @if($tab === 'archive')
                        <div class="p-10 text-center text-gray-500" data-i18n-app="noArchivedMessages">Aucun message archive pour le moment.</div>
                    @else
                        <div class="p-10 text-center text-gray-500" data-i18n-app="noInboxMessages">Aucun nouveau message pour le moment.</div>
                    @endif
                @else
                    <div class="divide-y divide-gray-200">
                        @foreach ($messages as $msg)
                            <div class="p-5 {{ $msg->read_at ? 'bg-white' : 'bg-blue-50/40' }}">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $msg->subject }}</p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span data-i18n-app="fromLabel">De:</span>
                                            @if($msg->sender && $msg->sender->name)
                                                {{ $msg->sender->name }}
                                            @else
                                                <span data-i18n-app="trainerFallback">Formateur</span>
                                            @endif
                                            ({{ $msg->email_professionnel }})
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $msg->created_at->format('Y-m-d H:i') }}</p>
                                    </div>

                                    @if (! $msg->read_at)
                                        <form method="POST" action="{{ route('admin.messages.read', $msg) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-xs bg-blue-600 text-white px-3 py-1 rounded-md" data-i18n-app="markReadBtn">
                                                Marquer comme lu
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-green-600 font-semibold" data-i18n-app="readLabel">Lu</span>
                                    @endif
                                </div>

                                <div class="mt-3 rounded-md border border-gray-200 bg-gray-50 p-3 text-sm text-gray-800 whitespace-pre-wrap">{{ $msg->message }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-4">{{ $messages->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
