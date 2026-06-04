@props([
    'title',
    'description',
])

<div class="flex w-full flex-col items-center text-center gap-4">

    <img
        src="{{ asset('images/unsri.svg') }}"
        alt="Logo UNSRI"
        class="h-24 w-auto"
    >

    <flux:heading size="xl">
        {{ $title }}
    </flux:heading>

    <flux:subheading>
        {{ $description }}
    </flux:subheading>

</div>