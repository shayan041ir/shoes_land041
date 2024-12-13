<h3>نظرات در انتظار تأیید</h3>
@php
    $comments = \App\Models\Comment::where('is_approved', false)->get();
@endphp
@forelse ($comments as $comment)
    <div class="border p-3 mb-2">
        <strong>{{ $comment->user->name }}</strong> گفت:
        <p>{{ $comment->content }}</p>
        <small class="text-muted">در {{ $comment->created_at->format('Y-m-d H:i') }}</small>

        <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success">تأیید</button>
        </form>

        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">حذف</button>
        </form>
    </div>
@empty
    <p>هیچ نظری در انتظار تأیید نیست.</p>
@endforelse
