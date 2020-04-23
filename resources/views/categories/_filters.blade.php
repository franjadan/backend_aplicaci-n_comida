<div class="row">
    <div class="col-sm-12 col-md-6"></div>
    <div class="col-sm-12 col-md-6 d-flex justify-content-end">
        <form action="{{ route('categories') }}" method="get" class="d-flex my-custom-search">
            <label for="inputSearch" class="d-inline-block">Buscar:</label>
            <input type="search" class="form-control form-control-sm" name="search" value="{{ request('search') }}" id="inputSearch">
        </form>
    </div>
</div>
