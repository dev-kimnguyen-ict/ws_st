@extends('template.admin.layouts.admin')

@section('page-body')
    <div class="panel panel-default panel-mod">
        {{--Filters--}}
        <div class="filters">
            <ul class="filter-tab-list">
                <li class="filter-tab-item active">
                    <a href="#" class="filter-tab">Tất cả sản phẩm</a>
                </li>
                <li class="filter-tab-item">
                    <a href="#" class="filter-tab">Lorem</a>
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
        {{--End filters--}}

        {{--Panel Body--}}
        <div class="panel-body">
            <div class="panel-row">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox">
                        </th>
                        <th></th>
                        <th>Sản phẩm</th>
                        <th>Kho hàng</th>
                        <th>Loại</th>
                        <th>Nhà cung cấp</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-row">
                <h3>Heading</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae enim et eum ex ipsa iste, iusto
                    laboriosam laborum necessitatibus nobis odio repellendus tempora ullam vel velit veniam vero
                    voluptatem! A ab aliquam aliquid aperiam atque, beatae, commodi doloribus ducimus earum error,
                    excepturi facere fugit in ipsa laboriosam magnam maiores molestiae nesciunt nulla perspiciatis
                    praesentium quaerat quasi qui quo ratione rem repellat repellendus soluta tempore tenetur totam
                    voluptas voluptate voluptatem? Assumenda aut blanditiis consectetur corporis cumque eius
                    eligendi exercitationem ipsum magnam, nemo nulla odit porro quaerat quos reiciendis repellendus
                    sunt voluptate voluptatem. A amet consequuntur dicta ea expedita, libero qui quos sunt!
                    Distinctio, ex, exercitationem! Eveniet molestiae nostrum optio quaerat quo! Amet assumenda
                    consequatur dolorem excepturi fugiat hic optio quis recusandae voluptate voluptatum. Accusamus
                    at corporis culpa debitis delectus dolore dolorem doloremque facere fuga fugiat inventore
                    itaque, nemo numquam perferendis porro praesentium quae quaerat quia quis quisquam suscipit
                    tempore tenetur totam voluptate voluptatem? A accusantium aperiam architecto at atque autem
                    blanditiis commodi, cumque delectus deserunt dolorem doloremque dolores ducimus eaque earum eius
                    est et eveniet fugiat hic id ipsa ipsam iste itaque magni maxime minima, modi mollitia nihil
                    numquam officia perferendis quis quos rem sequi ut velit! Accusantium aliquid architecto
                    aspernatur consequatur delectus deserunt dolores dolorum eius fuga iste minima molestias natus,
                    odio quaerat quam qui quisquam, quo quod repellat repudiandae sapiente sit soluta sunt voluptas
                    voluptatem? Beatae dolorem doloremque ducimus laudantium perspiciatis! A accusantium
                    consequuntur delectus dicta dolorem illo, ipsam itaque laborum libero provident sequi totam
                    voluptas. Aut debitis eaque id provident quibusdam quisquam quo reprehenderit suscipit! Ab
                    distinctio enim hic id, inventore itaque laboriosam maiores modi mollitia nemo neque nihil
                    perferendis placeat, provident reiciendis tenetur veniam voluptate? Consectetur cum pariatur
                    repellendus sapiente. Adipisci cum deserunt distinctio ea eaque earum eos et illum magnam maxime
                    minima necessitatibus nesciunt, nihil nisi porro tenetur, voluptate. Accusantium alias
                    architecto delectus distinctio, doloribus ducimus ex illum ipsa laborum minima nam nobis odit
                    optio provident quod quos vel velit veritatis! Ab aliquam consequatur consequuntur doloribus
                    explicabo fuga hic laboriosam maiores nesciunt nulla officia porro quidem sapiente sequi,
                    similique totam voluptas voluptatibus. Quibusdam, repellat voluptates. Ab architecto, aut beatae
                    commodi deserunt, dicta dolorum error fugiat id libero minus molestiae mollitia, nemo nesciunt
                    nulla odit pariatur perspiciatis praesentium quaerat quasi recusandae temporibus vel velit. A
                    adipisci aliquid amet, aperiam aut beatae culpa dolorem dolorum eligendi error esse expedita
                    explicabo hic id labore laboriosam molestiae mollitia non nostrum perspiciatis quaerat quasi quo
                    quos sapiente sed sequi soluta suscipit velit veritatis voluptas? Accusantium aperiam at
                    deleniti dolorem eos et facere id iste laboriosam maiores minima, placeat quisquam sapiente
                    sequi totam? Accusamus deserunt dolorem doloribus error et expedita harum illo illum iste iusto
                    magnam necessitatibus porro sed similique, totam vero voluptatem. Accusamus alias aperiam
                    dignissimos dolor doloribus eligendi eum eveniet id illum impedit nobis, omnis pariatur,
                    possimus, recusandae temporibus. Accusantium alias amet corporis culpa dicta est fuga id impedit
                    inventore iusto laudantium, magnam modi, mollitia nisi optio perferendis quae suscipit
                    voluptatibus! Aliquid aperiam atque blanditiis delectus distinctio dolore dolorum earum enim,
                    esse eum fugiat, libero minima molestias mollitia nam neque nesciunt odio porro possimus quam
                    quasi recusandae rem saepe sint suscipit tempore vel. Doloremque eligendi eveniet exercitationem
                    illo inventore ipsum magnam magni nihil numquam officiis quas recusandae repellat sed sit
                    voluptate, voluptatibus, voluptatum? Aliquid consequatur consequuntur corporis cupiditate
                    debitis eius eos est excepturi illo, incidunt iste, itaque laboriosam libero minima nesciunt
                    nobis nostrum obcaecati officiis optio porro praesentium quaerat quasi quis quod, quos ratione
                    repudiandae tempore tenetur unde veritatis. Asperiores, blanditiis, consequatur debitis dolorem
                    doloremque eaque eum eveniet ex facilis impedit ipsum minima, non odio omnis perspiciatis
                    praesentium quas qui reiciendis vero voluptatibus! Corporis cumque facere fuga fugit, nostrum
                    provident quis voluptatibus! Accusamus ad alias aut consequuntur culpa dolore eligendi impedit
                    labore modi nemo nisi non nostrum officia, quisquam quos tempore ut! Aliquid animi dolore earum
                    expedita illo iure laudantium, necessitatibus nesciunt nisi obcaecati odio porro praesentium
                    provident qui quo rem sapiente tempora totam, ullam vero! Alias, aperiam assumenda at excepturi
                    expedita harum ipsa ipsum iste nam, nesciunt possimus provident quia quidem quod reiciendis
                    reprehenderit soluta suscipit temporibus vitae voluptas. Atque facere magni pariatur placeat qui
                    rem sapiente veritatis, vitae? Ad animi hic quas sint vero. At eum hic quidem similique ullam
                    voluptatum? Ea exercitationem mollitia neque porro quidem, sed voluptatum? Aperiam consequuntur
                    doloribus esse et impedit laborum optio, quisquam quos sapiente unde! Aut consectetur iste
                    laborum nam, nobis numquam placeat quam! Architecto ipsa, officiis quae qui recusandae
                    voluptatem? Animi blanditiis est facere ipsa laborum maxime minima provident similique ullam,
                    veritatis? Alias amet asperiores assumenda autem beatae consequatur corporis cupiditate deleniti
                    eveniet in inventore iste itaque iure labore libero minima natus nesciunt nisi, odio quam quasi
                    quis quos reprehenderit temporibus tenetur, ut veritatis voluptatibus! Consequuntur fugiat iste
                    itaque magni molestias nihil nostrum perspiciatis voluptatem. Aut blanditiis consectetur debitis
                    iste itaque iusto labore minus, nam quaerat qui, quos veniam voluptatibus voluptatum! A adipisci
                    alias aliquid, amet asperiores autem dicta dolorum earum eius eos est facere facilis harum illo
                    illum impedit incidunt itaque labore laboriosam maiores maxime modi natus necessitatibus nemo
                    neque nostrum odio perspiciatis quia ratione reprehenderit sapiente sint soluta voluptatibus?
                    Aliquam beatae cupiditate ducimus eaque esse expedita explicabo impedit maiores molestias odio
                    perferendis possimus praesentium quam quidem quisquam quos sapiente soluta, totam veniam vitae,
                    voluptas voluptates voluptatibus? Architecto delectus doloribus dolorum inventore magni
                    necessitatibus nihil nostrum, officia pariatur ratione reiciendis rerum sint vitae! Ab at cumque
                    delectus ducimus ea et fugit id illum in, ipsum laudantium magnam magni maiores obcaecati
                    similique, sint tenetur, velit voluptatibus! Animi architecto cupiditate debitis distinctio
                    dolor doloremque illum ipsam minus modi, nam porro possimus praesentium quas quia quo
                    recusandae, rerum similique sunt temporibus voluptatibus! A accusamus, aut cumque, debitis
                    deleniti dolor eius libero non nostrum optio perferendis quae sunt velit! At eaque eligendi et
                    facere, facilis fugiat hic placeat porro quas qui similique vero voluptatum! Accusamus
                    accusantium architecto asperiores atque aut autem beatae commodi dicta eligendi enim esse est
                    eveniet exercitationem id maiores nam nesciunt, non numquam quaerat ratione repellat temporibus
                    unde veniam vero voluptates?
                </p>
            </div>
        </div>
        {{--End panel body--}}
    </div>
@endsection
