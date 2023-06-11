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
                <th style="text-align:left; padding-left: 50px">Name</th>
                <th style="">Duration</th>
                <th style="padding-right:50px">Author</th>
                <th scope="">Status</th>

            </tr>
        </thead>
        <tbody>
            <?php
            // $totalSodu = 0; // Biến lưu tổng Sodu
            
            // foreach ($posts as $key => $post) {
            //     $totalSodu += $post->Sodu; // Cộng dồn giá trị Sodu
            // }
            ?>
            @foreach ($cuisines as $key => $post)
                @php
                    $stt = $key + 1;
                @endphp
                {{-- @php
                    $cuisineCount = $usersWithCuisineCount[$loop->index];
                @endphp --}}
                <tr>
                    <td style="">{{ $stt }}</td>
                    <td style="">{{ $post->name }}</td>
                    <td style="">{{ $post->duration }}</td>
                    <td style="padding-right:50px">{{ $post->user->name }}</td>
                    <td><?php if ($post->status == '0') {
                        echo 'Pending';
                    } elseif ($post->status == '1') {
                        echo 'Approved';
                    } else {
                        echo 'Disapproved';
                    } ?></td>
                    {{-- <td>{!! \App\Helpers\Helper::price($post->Sodu) !!}đ</td> --}}

                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div style="margin-left: 430px; font-size: 20px;">Tổng cộng: {!! \App\Helpers\Helper::price($totalSodu) !!}đ</div> --}}
</body>
