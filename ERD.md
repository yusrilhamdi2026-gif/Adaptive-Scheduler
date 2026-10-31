# ERD ringkas

teachers 1---N teaching_assignments N---1 classes
subjects 1---N teaching_assignments
teaching_assignments 1---N schedules
periods 1---N schedules
rooms 1---N schedules

## Hard constraints
1. Teacher + period unik.
2. Class + period unik.
3. Room + period unik.
4. Room capacity >= jumlah siswa.
5. Room type sesuai kebutuhan mapel.
6. Guru hanya pada hari yang tersedia.
7. Slot istirahat tidak dipakai.

## Soft constraints
- preferensi jam guru
- pemerataan distribusi jadwal
- penalti jam terakhir
- kontinuitas ruang
- penalti perubahan ketika dynamic rescheduling

## Objective
Maksimalkan:
`score = w1*teacher_preference + w2*distribution + w3*avoid_last_period + w4*room_continuity - w5*change_penalty`
