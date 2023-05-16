<form role="search" method="get" class="searchform row row-cols-sm-auto g-3 align-items-center" action="<?php echo esc_url(home_url('/')); ?>">
    <?php $idBusca = uniqid(); ?>
    <a href="#inicio-busca" id="inicio-busca" class="visually-hidden">In&iacute;cio da busca</a>
    <div class="col-12">
        <label class="visually-hidden" for="<?php echo $idBusca; ?>">Buscar por:</label>
        <div class="input-group">
            <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="<?php echo $idBusca; ?>" class="form-control form-control-sm searchform__input" placeholder="Buscar em todo o site" required>
            <button type="submit" class="btn btn-light btn-sm searchform__submit">
                <?php $idSVG = uniqid(); ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="#000000" aria-labelledby="<?php echo $idSVG; ?>">
                    <title id="<?php echo $idSVG; ?>">Buscar</title>
                    <path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"/>
                </svg>
            </button>
        </div>
    </div>
</form>
