<?php

/**
 * 2007-2022 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author    PrestaShop SA <contact@prestashop.com>
 *  @copyright 2007-2022 PrestaShop SA
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

class Mobytic_custom_blocks_4 extends Module implements WidgetInterface
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'mobytic_custom_blocks_4';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Mobytic';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Mobytic - Custom - 4 Blocks');
        $this->description = $this->l('Modifier les 4 cartes sur la page d\'accueil');

        $this->confirmUninstall = $this->l('');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        $this->installTab();

        Configuration::updateValue('MOBYTIC_CUSTOM_BLOCKS_4_LIVE_MODE', false);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader');
    }

    public function installTab()
    {
        $response = true;

        // First check for parent tab
        $parentTabID = Tab::getIdFromClassName('AdminMobytic');

        if ($parentTabID) {
            $parentTab = new Tab($parentTabID);
        } else {
            $parentTab = new Tab();
            $parentTab->active = 1;
            $parentTab->name = array();
            $parentTab->class_name = "AdminMobytic";
            foreach (Language::getLanguages() as $lang) {
                $parentTab->name[$lang['id_lang']] = "Mobytic";
            }
            $parentTab->id_parent = 0;
            $parentTab->module = $this->name;
            $response &= $parentTab->add();
        }

        // Check for parent tab2
        $parentTab_2ID = Tab::getIdFromClassName('AdminMobyticThemeCustom');
        if ($parentTab_2ID) {
            $parentTab_2 = new Tab($parentTab_2ID);
        } else {
            $parentTab_2 = new Tab();
            $parentTab_2->active = 1;
            $parentTab_2->name = array();
            $parentTab_2->class_name = "AdminMobyticThemeCustom";
            foreach (Language::getLanguages() as $lang) {
                $parentTab_2->name[$lang['id_lang']] = "Theme Custom";
            }
            $parentTab_2->id_parent = $parentTab->id;
            $parentTab_2->module = $this->name;
            $response &= $parentTab_2->add();
        }

        // Created tab
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'Admin' . $this->name;
        $tab->name = array();
        foreach (Language::getLanguages() as $lang) {
            $tab->name[$lang['id_lang']] = "4 blocs";
        }
        $tab->id_parent = $parentTab_2->id;
        $tab->module = $this->name;
        $response &= $tab->add();

        return $response;
    }

    public function uninstall()
    {
        $this->uninstallTab();

        Configuration::deleteByName('MOBYTIC_CUSTOM_BLOCKS_4_LIVE_MODE');

        return parent::uninstall();
    }

    public function uninstallTab()
    {
        $id_tab = Tab::getIdFromClassName('Admin' . $this->name);
        $tab = new Tab($id_tab);
        $tab->delete();
        return true;
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        $values_block_1 = array(
            'nb' => 'Bloc 1',
            'img' => 'MOBYTIC_CUSTOM_BLOCKS_4_IMG_1',
            'title' => 'MOBYTIC_CUSTOM_BLOCKS_4_TITLE_1',
            'title_url' => 'MOBYTIC_CUSTOM_BLOCKS_4_TITLE_URL_1',
            'left' => 'MOBYTIC_CUSTOM_BLOCKS_4_TEXT_LEFT_1',
            'right' => 'MOBYTIC_CUSTOM_BLOCKS_4_TEXT_RIGHT_1',
            'btn' => 'submitMobytic_custom_submit_btn_1',
        );
        $block_1 = $this->getConfigFormValues_blocks($values_block_1);
        $values_block_2 = array(
            'nb' => 'Bloc 2',
            'img' => 'MOBYTIC_CUSTOM_BLOCKS_4_IMG_2',
            'title' => 'MOBYTIC_CUSTOM_BLOCKS_4_TITLE_2',
            'title_url' => 'MOBYTIC_CUSTOM_BLOCKS_4_TITLE_URL_2',
            'left' => 'MOBYTIC_CUSTOM_BLOCKS_4_TEXT_LEFT_2',
            'right' => 'MOBYTIC_CUSTOM_BLOCKS_4_TEXT_RIGHT_2',
            'btn' => 'submitMobytic_custom_submit_btn_2',
        );
        $block_2 = $this->getConfigFormValues_blocks($values_block_2);
        $values_block_3 = array(
            'nb' => 'Bloc 3',
            'img' => 'MOBYTIC_CUSTOM_BLOCKS_4_IMG_3',
            'title' => 'MOBYTIC_CUSTOM_BLOCKS_4_TITLE_3',
            'title_url' => 'MOBYTIC_CUSTOM_BLOCKS_4_TITLE_URL_3',
            'left' => 'MOBYTIC_CUSTOM_BLOCKS_4_TEXT_LEFT_3',
            'right' => 'MOBYTIC_CUSTOM_BLOCKS_4_TEXT_RIGHT_3',
            'btn' => 'submitMobytic_custom_submit_btn_3',
        );
        $block_3 = $this->getConfigFormValues_blocks($values_block_3);
        $values_block_4 = array(
            'nb' => 'Bloc 4',
            'img' => 'MOBYTIC_CUSTOM_BLOCKS_4_IMG_4',
            'title' => 'MOBYTIC_CUSTOM_BLOCKS_4_TITLE_4',
            'title_url' => 'MOBYTIC_CUSTOM_BLOCKS_4_TITLE_URL_4',
            'left' => 'MOBYTIC_CUSTOM_BLOCKS_4_TEXT_LEFT_4',
            'right' => 'MOBYTIC_CUSTOM_BLOCKS_4_TEXT_RIGHT_4',
            'btn' => 'submitMobytic_custom_submit_btn_4',
        );
        $block_4 = $this->getConfigFormValues_blocks($values_block_4);






        $output = null;

        // $output .= $this->uploadFileConditions('MOBYTIC_CUSTOM_HP_WELCOME_IMG');

        $this->context->smarty->assign('module_dir', $this->_path);

        $output .= $this->uploadFileConditions($this->getConfigFormValues(), '', 'submitMobytic_custom_submit_btn');
        $output .= $this->uploadFileConditions($block_1, $values_block_1['img'], $values_block_1['btn']);
        $output .= $this->uploadFileConditions($block_2, $values_block_2['img'], $values_block_2['btn']);
        $output .= $this->uploadFileConditions($block_3, $values_block_3['img'], $values_block_3['btn']);
        $output .= $this->uploadFileConditions($block_4, $values_block_4['img'], $values_block_4['btn']);

        $output .= $this->context->smarty->fetch($this->local_path . 'views/templates/admin/configure.tpl');

        $output .= $this->renderForm($this->getConfigForm(), $this->getConfigFormValues(), 'submitMobytic_custom_submit_btn');
        $output .= $this->renderForm($this->getConfigForm_Blocks($values_block_1), $block_1, $values_block_1['btn']);
        $output .= $this->renderForm($this->getConfigForm_Blocks($values_block_2), $block_2, $values_block_2['btn']);
        $output .= $this->renderForm($this->getConfigForm_Blocks($values_block_3), $block_3, $values_block_3['btn']);
        $output .= $this->renderForm($this->getConfigForm_Blocks($values_block_4), $block_4, $values_block_4['btn']);

        return $output;
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm($getConfigForm, $getConfigFormValues, $submit_action)
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = $submit_action;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $getConfigFormValues, /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($getConfigForm));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Paramètre'),
                    'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Afficher'),
                        'name' => 'MOBYTIC_CUSTOM_BLOCKS_4_LIVE_MODE',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Oui')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Non')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    protected function getConfigFormValues()
    {
        return array(
            'MOBYTIC_CUSTOM_BLOCKS_4_LIVE_MODE' => Configuration::get('MOBYTIC_CUSTOM_BLOCKS_4_LIVE_MODE', true),
        );
    }


    protected function getConfigForm_Blocks($value)
    {
        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l($value['nb']),
                    'icon' => 'icon-edit-sign',
                ),
                'input' => array(
                    array(
                        'type' => 'file',
                        'name' => $value['img'],
                        'label' => $this->l('Image'),
                        'display_image' => true,
                        'image' => $this->displayImgInForm($value['img']),
                    ),
                    array(
                        'type' => 'text',
                        'name' => $value['title'],
                        'prefix' => '<i class="icon icon-text-width"></i>',
                        'label' => $this->l('Titre'),
                    ),
                    array(
                        'type' => 'text',
                        'name' => $value['title_url'],
                        'prefix' => '<i class="icon icon-link"></i>',
                        'label' => $this->l('Lien du titre'),
                    ),
                    array(
                        'type' => 'textarea',
                        'autoload_rte' => true,
                        'tinymce' => true,
                        'class' => 'rte',
                        'cols' => 20,
                        'rows' => 10,
                        'name' => $value['left'],
                        'label' => $this->l('Liste à gauche'),
                    ),
                    array(
                        'type' => 'textarea',
                        'autoload_rte' => true,
                        'tinymce' => true,
                        'class' => 'rte',
                        'cols' => 20,
                        'rows' => 10,
                        'name' => $value['right'],
                        'label' => $this->l('Liste à droite'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    protected function getConfigFormValues_blocks($value)
    {
        return array(
            $value['title'] => Configuration::get($value['title']),
            $value['title_url'] => Configuration::get($value['title_url']),
            $value['left'] => Configuration::get($value['left']),
            $value['right'] => Configuration::get($value['right']),
        );
    }



    /**
     * Save form data.
     */
    protected function postProcess($getConfigFormValues)
    {
        $form_values = $getConfigFormValues;

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key), true);
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path . 'views/js/back.js');
            $this->context->controller->addCSS($this->_path . 'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path . '/views/js/front.js');
        $this->context->controller->addCSS($this->_path . '/views/css/front.css');
    }







    public function getVariables()
    {
        $values = [];

        for ($i = 1; $i <= 4; $i++) {
            $values += [
                'img_' . $i => $this->getImgURL('MOBYTIC_CUSTOM_BLOCKS_4_IMG_' . $i),
                'title_' . $i => Configuration::get('MOBYTIC_CUSTOM_BLOCKS_4_TITLE_' . $i, Tools::getValue('MOBYTIC_CUSTOM_BLOCKS_4_TITLE_' . $i)),
                'title_url_' . $i => Configuration::get('MOBYTIC_CUSTOM_BLOCKS_4_TITLE_URL_' . $i, Tools::getValue('MOBYTIC_CUSTOM_BLOCKS_4_TITLE_URL_' . $i)),
                'left_' . $i => Configuration::get('MOBYTIC_CUSTOM_BLOCKS_4_TEXT_LEFT_' . $i, Tools::getValue('MOBYTIC_CUSTOM_BLOCKS_4_TEXT_LEFT_' . $i)),
                'right_' . $i => Configuration::get('MOBYTIC_CUSTOM_BLOCKS_4_TEXT_RIGHT_' . $i, Tools::getValue('MOBYTIC_CUSTOM_BLOCKS_4_TEXT_RIGHT_' . $i)),
            ];
        }

        return $this->context->smarty->assign($values);
    }


    // ************************************************************ 
    // Widget
    // ************************************************************
    public function renderWidget($hookName, array $configuration)
    {
        $this->getWidgetVariables($hookName, $configuration);
        return $this->fetch('module:' . $this->name . '/views/templates/widget/mobytic_custom_blocks_4.tpl');
    }

    public function getWidgetVariables($hookName, array $configuration)
    {
        $this->getVariables();
    }









    // ****************************************************
    // FONCTIONS
    // ****************************************************
    protected function uploadFileConditions($getValues, $img_uploaded, $btn)
    {
        if (((bool)Tools::isSubmit($btn)) == true) {
            $this->postProcess($getValues);
            return $this->checkUploadFile($img_uploaded);
        }
    }
    protected function checkUploadFile($img_uploaded)
    {
        if (isset($_FILES[$img_uploaded])) {
            $file = $_FILES[$img_uploaded];

            // File properties
            $file_name = $file['name'];
            $file_tpm = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];

            // Work out the file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('jpg', 'png', 'jpeg');

            if (in_array($file_ext, $allowed)) {
                move_uploaded_file($_FILES[$img_uploaded]['tmp_name'], dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/img' . DIRECTORY_SEPARATOR . $_FILES[$img_uploaded]["name"]);
                Configuration::updateValue($img_uploaded, Tools::getValue($img_uploaded));
                return $this->displayConfirmation($this->l('Mise à jour réussie'));
            } else {
                return $this->displayError($this->l('Mauvais format / Vous aviez laissé la même photo (ne pas tenir en compte)'));
            }
        }
    }

    protected function displayImgInForm($img_uploaded)
    {
        $img_name = Configuration::get($img_uploaded);
        $img_url = $this->context->link->protocol_content . Tools::getMediaServer($img_name) . $this->_path . 'views/img/' . $img_name;
        return $img = $img_name ? '<div class="col-lg-6"><img src="' . $img_url . '" class="img-thumbnail" width="200"></div>' : "";
    }

    protected function getImgURL($img_uploaded)
    {
        $img_name = Configuration::get($img_uploaded);
        return $img_name ? $this->context->link->protocol_content . Tools::getMediaServer($img_name) . $this->_path . 'views/img/' . $img_name : '';
    }
}
