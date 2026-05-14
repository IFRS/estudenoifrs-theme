<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <?php $idBusca = uniqid(); ?>
    <a href="#inicio-busca" id="inicio-busca" class="visually-hidden">In&iacute;cio da busca</a>
    <label class="visually-hidden" for="<?php echo $idBusca; ?>">Buscar por:</label>
    <div class="input-group">
        <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="<?php echo $idBusca; ?>" class="form-control searchform__input" placeholder="Buscar em todo o site" required>
        <button type="submit" class="btn btn-light searchform__submit" aria-label="Buscar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
</form>
