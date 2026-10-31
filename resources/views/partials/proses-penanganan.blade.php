      <section aria-labelledby="proses-heading">
        <h2 id="proses-heading">Proses Penanganan</h2>
        <p id="proses-deskripsi">
          @isset($laporan)
            @if ($laporan->status === 'baru')
              Laporan ini baru diterima dan belum memiliki catatan penanganan dari petugas.
            @else
              Status laporan saat ini: {{ ucfirst($laporan->status) }}.
            @endif
          @endisset
        </p>

        @if (isset($laporan))
          @php
            $tahapAktif = match ($laporan->status) {
              'diproses' => 2,
              'selesai' => 3,
              'ditolak' => 1,
              default => 0,
            };
          @endphp
          <ol aria-label="Tahapan proses penanganan">
            <li class="timeline-step--complete">
              <span class="timeline-indicator" aria-hidden="true"></span>
              <article>
                <h3>Laporan Diterima</h3>
                <p>Laporan masuk dan tercatat di sistem.</p>
                <p><time datetime="{{ $laporan->created_at->timezone('Asia/Jakarta')->toIso8601String() }}">{{ $laporan->created_at->timezone('Asia/Jakarta')->format('d M Y, H.i') }} WIB</time></p>
              </article>
            </li>
            @foreach ([
              ['Survei Lokasi', 'Petugas akan memeriksa kondisi di lokasi laporan.'],
              [$laporan->status === 'ditolak' ? 'Laporan Ditolak' : 'Proses Penanganan', $laporan->status === 'ditolak' ? 'Laporan tidak dapat dilanjutkan.' : 'Petugas akan menindaklanjuti laporan.'],
              ['Selesai', 'Penanganan laporan telah selesai.'],
            ] as $index => [$judulTahap, $deskripsiTahap])
              @php
                $nomorTahap = $index + 1;
                $kelasTahap = $nomorTahap < $tahapAktif
                  ? 'timeline-step--complete'
                  : ($nomorTahap === $tahapAktif
                    ? ($laporan->status === 'selesai' ? 'timeline-step--complete' : 'timeline-step--current')
                    : 'timeline-step--pending');
              @endphp
              <li class="{{ $kelasTahap }}">
                <span class="timeline-indicator" aria-hidden="true"></span>
                <article>
                  <h3>{{ $judulTahap }}</h3>
                  <p>{{ $deskripsiTahap }}</p>
                  @if ($nomorTahap < $tahapAktif)
                    <p>Selesai</p>
                  @elseif ($nomorTahap === $tahapAktif)
                    <p>Sedang berlangsung</p>
                  @else
                    <p>Menunggu</p>
                  @endif
                </article>
              </li>
            @endforeach
          </ol>
        @else
        <ol aria-label="Tahapan proses penanganan">
          <li>
            <span class="timeline-indicator" aria-hidden="true"></span>
            <article>
              <h3>Laporan Diterima</h3>
              <p>Laporan masuk dan terverifikasi oleh sistem.</p>
              <p><time datetime="2026-10-07T08:00">07 Okt 2026, 08.00 WIB</time></p>
            </article>
          </li>
          <li>
            <span class="timeline-indicator" aria-hidden="true"></span>
            <article>
              <h3>Survei Lokasi</h3>
              <p>Petugas melakukan survei kondisi lapangan di lokasi laporan.</p>
              <p><time datetime="2026-10-07T10:30">07 Okt 2026, 10.30 WIB</time></p>
            </article>
          </li>
          <li>
            <span class="timeline-indicator" aria-hidden="true"></span>
            <article>
              <h3>Proses Penanganan</h3>
              <p>Tim penanganan mulai bekerja di lokasi.</p>
              <p><time datetime="2026-10-07T13:00">07 Okt 2026, 13.00 WIB</time></p>
            </article>
          </li>
          <li>
            <span class="timeline-indicator" aria-hidden="true"></span>
            <article>
              <h3>Selesai</h3>
              <p>Penanganan selesai dan lokasi siap digunakan kembali.</p>
              <p><time datetime="2026-10-08T16:00">08 Okt 2026, 16.00 WIB</time></p>
            </article>
          </li>
        </ol>
        @endif
      </section>
