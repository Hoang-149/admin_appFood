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
                <th style="width: 200px;">Tên Người Dùng</th>
                <th style="width: 300px;">Email</th>
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
                <tr>
                    <td style="">{{ $stt }}</td>
                    <td style="padding-left: 50px">{{ $post->name }}</td>
                    <td style="padding-left: 50px">{{ $post->email }}</td>
                    {{-- <td>{!! \App\Helpers\Helper::price($post->Sodu) !!}đ</td> --}}

                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div style="margin-left: 430px; font-size: 20px;">Tổng cộng: {!! \App\Helpers\Helper::price($totalSodu) !!}đ</div> --}}
</body>
