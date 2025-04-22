<x-layout>
    <div class="conversations-page container mx-auto mt-10">

        {{-- page header --}}
        @if ($conversations->isNotEmpty())
            <x-page-header label='My Conversations' updatedClass='text-center mb-7' />
        @endif        

        {{-- conversations container --}}
        <section
            class="conversations-list {{ $conversations->isNotEmpty() ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4' : '' }} mb-5">
            @forelse ($conversations as $conversation)
                <x-conversationsPage.conversation-card :conversation="$conversation" />
            @empty
                <x-no-data-message message="You have no active conversations" />
            @endforelse
        </section>

        {{-- pagination --}}
        <section class="pagination-option mb-10">
            {{ $conversations->links() }}
        </section>

    </div>
</x-layout>