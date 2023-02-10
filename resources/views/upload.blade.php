<form method="POST" action="/upload" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button>アップロード</button>
</form>