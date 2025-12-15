<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-800">Pengaturan Profil</h2>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
