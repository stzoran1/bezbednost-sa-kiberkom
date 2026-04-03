<div class="bg-purple-50 rounded-2xl p-6">
    <h3 class="text-xl md:text-2xl font-extrabold text-purple-700 mb-4">
        Tabela rezultata
    </h3>

    @if ($scores->isEmpty())
        <p class="text-lg text-gray-500">Još nema rezultata. Budi prvi!</p>
    @else
        <table class="w-full text-left">
            <thead>
                <tr class="border-b-2 border-purple-200">
                    <th class="py-2 px-2 text-base font-bold text-purple-600">#</th>
                    <th class="py-2 px-2 text-base font-bold text-purple-600">Igrač / Tim</th>
                    <th class="py-2 px-2 text-base font-bold text-purple-600 text-right">Rezultat</th>
                    <th class="py-2 px-2 text-base font-bold text-purple-600 text-right">Vreme</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scores as $index => $entry)
                    <tr class="border-b border-purple-100 {{ $index < 3 ? 'font-bold' : '' }}">
                        <td class="py-2 px-2 text-base">
                            @if ($index === 0)
                                🥇
                            @elseif ($index === 1)
                                🥈
                            @elseif ($index === 2)
                                🥉
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td class="py-2 px-2 text-base text-gray-800">{{ $entry->player_name }}</td>
                        <td class="py-2 px-2 text-base text-right text-gray-800">
                            {{ $entry->score }} / {{ $entry->total_questions }}
                        </td>
                        <td class="py-2 px-2 text-base text-right text-gray-500 font-mono">
                            {{ floor($entry->time_seconds / 60) }}:{{ str_pad($entry->time_seconds % 60, 2, '0', STR_PAD_LEFT) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Reset Leaderboard --}}
    <div class="mt-4 pt-4 border-t border-purple-200">
        @if ($this->resetSuccess)
            <p class="text-green-600 font-semibold text-base">Tabela rezultata je uspešno obrisana!</p>
        @elseif ($this->showResetForm)
            <form wire:submit="resetLeaderboard" class="flex flex-col sm:flex-row items-center gap-2">
                <input
                    wire:model="resetPassword"
                    type="password"
                    placeholder="Unesite lozinku..."
                    class="px-3 py-2 text-base rounded-lg border border-purple-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none"
                >
                <button
                    type="submit"
                    class="px-4 py-2 bg-red-500 text-white text-base font-bold rounded-lg hover:bg-red-600 transition-colors"
                >
                    Potvrdi
                </button>
                @if ($this->resetError)
                    <p class="text-red-500 text-sm font-semibold">{{ $this->resetError }}</p>
                @endif
            </form>
        @else
            <button
                wire:click="$set('showResetForm', true)"
                class="text-red-500 hover:text-red-700 text-sm font-semibold underline transition-colors"
            >
                Obriši tabelu rezultata
            </button>
        @endif
    </div>
</div>
