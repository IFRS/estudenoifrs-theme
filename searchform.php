<form role="search" method="get" class="searchform form-inline" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="search-field">Buscar por:</label>
    <div class="input-group">
        <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="search-field" class="form-control form-control-sm searchform__input" placeholder="Termo da Busca" required>
        <span class="input-group-append">
            <button type="submit" class="btn btn-sm searchform__submit">
                <span class="sr-only">Buscar no Site</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 11" width="18px" height="18px">
                    <g>
                        <path d="M8.93 4.77a3.75 3.75 0 0 1-.57 1.87c-.17.28-.23.42.14.67a12.08 12.08 0 0 1 2.35 2.28c.44.51-.2.78-.46 1.1s-.57.45-.88.13a15 15 0 0 1-2.28-2.44c-.25-.41-.43-.09-.6 0a4.41 4.41 0 0 1-3.5.34A4.48 4.48 0 0 1 .05 3.91 4.31 4.31 0 0 1 2.79.35a4.3 4.3 0 0 1 4.61.77 4.53 4.53 0 0 1 1.53 3.65zm-4.48-3a2.57 2.57 0 0 0-2.67 2.69 2.58 2.58 0 0 0 2.71 2.71 2.58 2.58 0 0 0 2.67-2.68 2.56 2.56 0 0 0-2.71-2.7z"/>
                    </g>
                </svg>
            </button>
        </span>
    </div>
</form>
