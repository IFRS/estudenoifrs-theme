<form role="search" method="get" class="searchform row row-cols-sm-auto g-3 align-items-center" action="<?php echo esc_url(home_url('/')); ?>">
    <?php $idBusca = uniqid(); ?>
    <a href="#inicio-busca" id="inicio-busca" class="visually-hidden">In&iacute;cio da busca</a>
    <div class="col-12">
        <label class="visually-hidden" for="<?php echo $idBusca; ?>">Buscar por:</label>
        <div class="input-group">
            <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="<?php echo $idBusca; ?>" class="form-control form-control-sm border searchform__input" placeholder="Buscar em todo o site" required>
            <button type="submit" class="btn btn-light btn-sm border searchform__submit">
                <span class="visually-hidden">Buscar</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" width="16" height="16" class="align-text-bottom" aria-hidden="true">
                    <g>
                        <path d="M8.93 4.77a3.75 3.75 0 0 1-.57 1.87c-.17.28-.23.42.14.67a12.08 12.08 0 0 1 2.35 2.28c.44.51-.2.78-.46 1.1s-.57.45-.88.13a15 15 0 0 1-2.28-2.44c-.25-.41-.43-.09-.6 0a4.41 4.41 0 0 1-3.5.34A4.48 4.48 0 0 1 .05 3.91 4.31 4.31 0 0 1 2.79.35a4.3 4.3 0 0 1 4.61.77 4.53 4.53 0 0 1 1.53 3.65zm-4.48-3a2.57 2.57 0 0 0-2.67 2.69 2.58 2.58 0 0 0 2.71 2.71 2.58 2.58 0 0 0 2.67-2.68 2.56 2.56 0 0 0-2.71-2.7z"/>
                    </g>
                </svg>
            </button>
        </div>
    </div>
</form>
