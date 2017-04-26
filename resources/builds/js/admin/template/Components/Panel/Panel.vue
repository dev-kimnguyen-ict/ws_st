<template>
    <div class="panel panel-default panel-mod">
        <div class="filters">
            <ul class="filter-tab-list">
                <li class="filter-tab-item active">
                    <a href="#" class="filter-tab">Tất cả sản phẩm</a>
                </li>
            </ul>
            <div class="filter-container">
                <div class="form-horizontal">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button
                                type="button"
                                class="btn btn-secondary dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"
                            >
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                        <input
                            id="txtkey"
                            type="text"
                            class="form-control"
                            placeholder="Enter here"
                            aria-describedby="ddlsearch"
                        >
                        <span class="input-group-btn">
                                <button id="btn-search" class="btn btn-info" type="button">
                                    <i class="fa fa-search fa-fw"></i>
                                </button>
                            </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        //
    }
</script>
