<?php

namespace Kodansha\KillerPads;

class AutosavePad
{
    /**
     * Initializes the AutosavePad functionality.
     *
     * This method sets up any necessary hooks or actions required * for the
     * AutosavePad to operate within the plugin.
     *
     * @return void
     */
    public function init()
    {
        add_action('admin_enqueue_scripts', [$this, 'deregisterAutosaveScript']);
        add_filter('block_editor_settings_all', [$this, 'setLongAutosaveInterval']);
    }

    /**
     * Deregisters the autosave script for the editor.
     *
     * @return void
     */
    public function deregisterAutosaveScript()
    {
        wp_deregister_script('autosave');
    }

    /**
     * Sets a longer autosave interval (1 day) for the block editor.
     *
     * @param array $editor_settings Default editor settings
     * @return array The modified editor settings with the updated autosave interval.
     */
    public function setLongAutosaveInterval(array $editor_settings)
    {
        $editor_settings['autosaveInterval'] = 86400;
        return $editor_settings;
    }
}
