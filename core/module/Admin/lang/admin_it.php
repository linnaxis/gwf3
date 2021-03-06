<?php
$lang = array(
	# Admin Config
	'cfg_users_per_page' => 'Utenti per Pagina',	
	'cfg_super_hash' => 'Password extra per il modulo Admin',
	'cfg_super_time' => 'Tempo per cui la password extra resta valida',

	# Info
	'install_info' => 'Alcuni moduli devono essere aggiornati, può anche <a href="%s">aggiornare ed installare tutti i moduli</a>.',
	'info_methods' => 'Controllo di %s metodi nel modulo...',
	
	# Select
	'sel_group' => 'Seleziona gruppo utente',
	
	# Titles
	'form_title' => 'Configura %s',
	'ft_setup' => 'Imposta una password Superuser aggiuntiva',
	'ft_prompt' => 'Inserisci la password Superuser aggiuntiva',
	'ft_login_as' => 'Accedi come un altro uente',
	'ft_useredit' => 'Modifica l\'utente %s',
	'ft_search' => 'Cerca nella tabella utenti.',
	'ft_edit_group' => 'Modifica Gruppo %s',
	'ft_add_to_group' => 'Aggiungi un utente a questo gruppo',
	'ft_add_group' => 'Crea un nuovo gruppo',

	# Errors
	'err_mod_not_installed' => 'Il modulo non è installato.',
	'err_not_installed' => 'Il modulo %s non è stato ancora installato.',
	'err_arg_script' => 'Non può cambiare il valore di &quot;%s&quot; manualmente.',
	'err_arg_type' => 'Argomenti invalidi per &quot;%s&quot;.',
	'err_arg_range' => 'Il valore per &quot;%s&quot; deve essere compreso tra %s e %s.',
	'err_arg_key' => 'Variablile sconosciuta &quot;%s&quot;.',
	'err_update' => 'Si è verificato un errore durante l\'aggiornamento',
	'err_install' => 'Si è verificato un errore durante l\'installazione.',
	'err_check_pass' => 'La password Superuser è sbagliata.',
	'err_username_taken' => 'Il nome utente è già stato scelto.',
	'err_username' => 'Il nome utente è invalido.',
	'err_email' => 'L\'E-Mail è invalida.',
	'err_gender' => 'Il sesso è invalido.',
	'err_group' => 'ID del gruppo sconosciuto.',
	'err_group_view' => 'La visibilità del gruppo è invalida.',
	'err_group_join' => 'La modalità di invito del gruppo è invalida.',
	'err_in_group' => 'L\'utente è già iscritto al gruppo.',
	'err_disable_core_module' => 'Questo modulo non può essere disabilitato perché fa parte dei moduli di base.',

	# Messages
	'msg_update_var' => 'Il valore per &quot;%s&quot; è stato modificato in %s.',
	'msg_update' => 'Modulo configurato',
	'msg_install' => 'Il modulo %s è stato re-installato. Aggiornamento database..',
	'msg_wipe_confirm' => 'Vuole veramente cancellare i dati presenti nei database utilizzat dal modulo %s?',
	'msg_wipe' => 'Il modulo %s è stato cancellato dal disco. Tutti i dati sono stati eliminati.',
	'msg_installed' => 'Può continuare con la <a href="%s">configurazione del modulo %s</a>.',
	'msg_install_all' => 'TUtti i modulo sono stati attivati con richieste di installazione/aggiornamento.<br/><a href="%s">Clicca qui per tornare alla panoramica moduli</a>.',
	'msg_enabled' => 'Il modulo è stato attivato.',
	'msg_disabled' => 'Il modulo è stato disattivato.',
	'msg_pass_cleared' => 'La password Superuser è stata rimossa.',
	'msg_pass_set' => 'La password Superuser è ora &quot;%s&quot;. Non la dimentichi, poichè non può essere recuperata o cambiata facilmente.',
	'msg_login_as' => 'Ha effettuato l\'accesso come %s.',
	'msg_userpass_changed' => 'La password per %s è ora &quot;%s&quot;.',
	'msg_username_changed' => 'L\'utente %s ha scelto di modificare il suo nome utente in %s.',
	'msg_user_edited' => 'L\'utente è stato modificato con successo.',
	'msg_deleted' => 'L\'utente è stato ontrassegnato come cancellato.',
	'msg_undeleted' => 'L\'utente è stato contrassegnato come attivato.',
	'msg_bot_0' => 'L\'utente non è più contrassegnato come Bot.',
	'msg_bot_1' => 'L\'utente è stato contrassegnato come Bot.',
	'msg_showemail_0' => 'L\'indirizzo E-Mail dell\'utente non verrà visualizzato pubblicamente.',
	'msg_showemail_1' => 'L\'indirizzo E-Mail dell\'utente verrà visualizzato pubblicamente.',
	'msg_adult_0' => 'I contenuti per adulti sono stai nascosti all\'utente.',
	'msg_adult_1' => 'L\'utente potrà, d\'ora in poi, visualizzare i contenuti per adulti.',
	'msg_online_0' => 'L\'utente verrà visualizzato nella lista degli utenti online.',
	'msg_online_1' => 'L\'utente non verrà visualizzato nella lista degli utenti online.',
	'msg_approved_0' => 'L\'indirizzo E-Mail dell\'utente non è più valido.',
	'msg_approved_1' => 'L\'indirizzo E-Mail dell\'utente è stato validato.',
	'msg_module_enabled' => 'Il modulo %s è stato attivato.',
	'msg_module_disabled' => 'Il modulo %s è stato disattivato.',
	'msg_new_path' => 'Il percorso del modulo è stato modificato con successo.',
	'msg_new_name' => 'Il modulo è stato ridenominato in %s. <b>Attenzione</b>: questa operazione renderà inutilizzabile la maggior parte degli URL!',
	'msg_defaults' => 'Le variabili del modulo sono state ripristinate ai loro valori di default.',
	'msg_removed_from_grp' => 'RImosso l\'utente %s dal gruppo %s.',
	'msg_added_to_grp' => 'Aggiungo l\'utente %s al gruppo %s.',

	# Table Headers
	'th_modulename' => 'Modulo',
	'th_path' => 'Percorso',
	'th_version_db' => 'Versione',
	'th_version_hd' => 'Disponibile',
	'th_priority' => 'Priorità',
	'th_move' => 'Muovi',
	'th_name' => 'Nome Modulo',
	'th_install' => 'Installa',
	'th_basic' => 'Configura',
	'th_adv' => 'Sezione Admin',
	'th_enabled' => 'Il modulo è attivato',
	'th_disabled' => 'Il modulo è disattivato',
	'th_new_pass' => 'Nuova password',
	'th_check_pass' => 'Password ',
	'th_userid' => 'ID ',
	'th_user_name' => 'Nome utente',
	'th_email' => 'E-Mail',
	'th_lastactivity' => 'Ultima attività',
	'th_regip' => 'IP di registrazione',
	'th_regdate' => 'Data di registrazione',
	'th_gender' => 'Sesso',
	'th_country' => 'Nazione',
	'th_lang_1' => 'Lingua primaria',
	'th_lang_2' => 'Lingua secondaria',
	'th_is_approved' => 'Ha vaildato l\'E-Mail?',
	'th_is_bot' => 'E\' un bot?',
	'th_hide_online' => 'Nascondi stato online?',
	'th_show_email' => 'Mostra E-Mail pubblicamente?',
	'th_want_adult' => 'Mostra contenuti per adulti?',
	'th_deleted' => 'Utente cancellato?',
	'th_birthdate' => 'Data di nascita',
	'th_cfg_div' => 'Variabili di configurazione di %s',
	'th_group_name' => 'Nome gruppo',
	'th_group_sel_view' => 'Visibilità',
	'th_group_sel_join' => 'Modalità di Invito',
	'th_group_lang' => 'Lingua',
	'th_group_country' => 'Nazione',
	'th_group_founder' => 'Fondatore',
	'th_group_options&1' => 'Il gruppo è pieno',
	'th_group_options&2' => 'Su invito',
	'th_group_options&4' => 'Tramite lista di moderazione',
	'th_group_options&8' => 'Clicca ed unisciti',
	'th_group_options&16' => 'Pieno (invito tramite script)',
	'th_group_options&'.(0x100) => 'Visibilità pubblica',
	'th_group_options&'.(0x200) => 'Visibilità agli utenti registrati',
	'th_group_options&'.(0x400) => 'Visibilità agli utenti del gruppo',
	'th_group_options&'.(0x800) => 'Visibilità al gruppo, tramite script',
	'th_group_id' => 'ID ',
	'th_group_memberc' => '# ',
	'th_group_join' => 'Opzioni di iscrizione',
	'th_group_view' => 'Opzioni di visualizzazione',
	
	# Buttons
	'btn_install' => 'Installa',
	'btn_reinstall' => 'Cancella DB',
	'btn_update' => 'Aggiorna',
	'btn_edit' => 'Modifica',
	'btn_config' => 'Configura',
	'btn_admin_section' => 'Sezione Admin',
	'btn_enable' => 'Attiva modulo',
	'btn_disable' => 'Disattiva modulo',
	'btn_modules' => 'Moduli',
	'btn_superuser' => 'Superuser ',
	'btn_users' => 'Utenti',
	'btn_groups' => 'Gruppi',
	'btn_login_as' => 'Accedi come',
	'btn_login_as2' => 'Accedi come %s',
	'btn_setup' => 'Imposta un nuova password',
	'btn_login' => 'Accedi',
	'btn_edit_user' => 'Modifica utente',
	'btn_cronjob' => 'Cronjob ',
	'btn_defaults' => 'Resetta',
	'btn_add_to_group' => 'Aggiungi al gruppo',
	'btn_rem_from_group' => 'Rimuovi dal gruppo',
	'btn_user_groups' => 'Modifica i gruppi di %s',
	'btn_add_to_grp' => 'Aggiungi al gruppo',
	'btn_add_group' => 'Aggiungi gruppo',

	# Tooltips
	'tt_int' => 'Valore intero compreso tra %s e %s.',
	'tt_text' => 'Testo con lunghezza compresa tra %s e %s caratteri.',
	'tt_bool' => 'Valore booleano.',
	'tt_script' => 'Valore script controllato autonomamente dal modulo.',
	'tt_time' => 'Durata compresa tra %s e %s.',
	'tt_float' => 'Numero reale compreso tra %s e %s.',

	#v2.01 (Add Group)
	'ft_add_group' => 'Aggiungi al gruppo',
	'btn_add_group' => 'Aggiungi gruppo',
	'msg_group_added' => 'Gruppo aggiunti.',
	'err_groupname' => 'Il nome del gruppo è invalido. deve avere una lunghezza compresa tra %s e %s caratteri.',

	#v2.02 (refinish)
	'ft_install' => 'Installa il modulo %s',
	'th_reinstall' => 'Elimina le tabelle del Database e re-installa',
	'err_no_admin_sect' => 'Questo modulo non ha nessuna sezione Admin.',
	'err_module' => 'Il modulo %s è sconosciuto.',
	'pi_install' => 'Il modulo %s ha %s tabelle nel database:<br/>%s',
	
	#v2.03 (creds+level)
	'th_user_credits' => '$ ',
	'th_user_level' => 'Livello',

	#v2.04 (drop wrapper)
	'ft_reinstall' => 'Re-installa modulo %s',
	'th_reset' => 'Re-imposta le variabili del modulo',

	#v2.05 (finish2)
	'btn_install_all' => 'Installa tuti i moduli',

	#v2.06 (GPG)
	'err_gpg_key' => 'La firma GPG sembra invalida.',
	'msg_gpg_key' => 'La preghiamo di usare questa come fingerprint nel file config.php: %s',

	#v2.07 (fix)
	'msg_edit_group' => 'Il gruppo è stato modificato.',
	'msg_mod_del' => 'Il modulo è stato cancellato dal database.',
	'btn_delete' => 'Cancella',
		
	# monnino fixes
	'cfg_hide_web_spiders' => 'Nascondi Webspider',
	'cfg_install_webspiders' => 'Installa Webspider',
	'btn_add' => 'Aggiungi gruppo'
);
?>
