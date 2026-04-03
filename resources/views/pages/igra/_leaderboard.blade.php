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
</div>
