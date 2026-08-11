<div class="lg:sticky lg:top-6 self-start">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-slate-900">
                Live Preview
            </h2>

            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-[10px] font-bold text-slate-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2 2z"/>
                </svg>
                Website view
            </span>
        </div>

        <div class="mt-4">
            {{ $slot }}
        </div>
    </div>
</div>