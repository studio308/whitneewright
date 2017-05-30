<div class="col col-lg-2">
    <div class="list-group">
        <a href="{{ route('admin.index') }}" class="list-group-item list-group-item-action {{ $page == 'index' ? 'active' : ''}}">Admin Home</a>
        <a href="{{ route('admin.categories') }}" class="list-group-item list-group-item-action {{ $page == 'categories'? 'active' : ''}}">Categories</a>
        <a href="{{ route('admin.works') }}" class="list-group-item list-group-item-action {{ $page == 'addWorks'? 'active' : ''}}">Add Work</a>
        <a href="#" class="list-group-item list-group-item-action">Add Event</a>
    </div>
</div>