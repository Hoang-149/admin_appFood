<style>
    @font-face {
        font-family: 'DejaVu Sans';
        /* src: url('/fonts/Roboto-ThinItalic.ttf') format('truetype'); */
    }

    body {
        font-family: 'DejaVu Sans', sans-serif;
    }
</style>

<body>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th style="width: 120px;">Name</th>
                <th style="width: 100px;">Email</th>
                <th style="width: 100px;padding-left: 50px">Role</th>
                <th style="width: 100px;">Cuisines</th>
                {{-- <th>Đã nạp</th> --}}
            </tr>
        </thead>
        <tbody>
            <?php
            // $totalSodu = 0; // Biến lưu tổng Sodu
            
            // foreach ($posts as $key => $post) {
            //     $totalSodu += $post->Sodu; // Cộng dồn giá trị Sodu
            // }
            ?>
            @foreach ($posts as $key => $post)
                @php
                    $stt = $key + 1;
                @endphp
                @php
                    $cuisineCount = $usersWithCuisineCount[$loop->index];
                @endphp
                <tr>
                    <td style="">{{ $stt }}</td>
                    <td style="padding-left: 50px">{{ $post->name }}</td>
                    <td style="padding-left: 50px">{{ $post->email }}</td>
                    <td style="padding-left: 100px">{{ $post->role == '1' ? 'Admin' : 'User' }}</td>
                    <td style="padding-left: 50px">{{ $cuisineCount->cuisine_count }}</td>

                    {{-- <td>{!! \App\Helpers\Helper::price($post->Sodu) !!}đ</td> --}}

                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div style="margin-left: 430px; font-size: 20px;">Tổng cộng: {!! \App\Helpers\Helper::price($totalSodu) !!}đ</div> --}}
</body>
