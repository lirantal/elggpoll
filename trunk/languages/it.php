<?php

    $italian = array(
    
        /**
         * Menu items and titles
         */
    
            'poll' => "Sondaggio",
            'polls' => "Sondaggi",
            'poll:user' => "I sondaggi di %s",
            'polls:user' => "I sondaggi di %s",
            'poll:user:friends' => "I sondaggi degli amici di %s",
            'poll:your' => "I tuoi sondaggi",
            'poll:posttitle' => "Sondaggio di %s: %s",
            'poll:friends' => "Sondaggi degli amici",
            'poll:yourfriends' => "Gli ultimi sondaggi dei tuoi amici",
            'poll:everyone' => "Tutti i sondaggi del sito",
            'poll:read' => "Leggi sondaggio",
            'poll:addpost' => "Crea un sondaggio",
            'poll:editpost' => "Modifica un sondaggio",
            'poll:text' => "Testo del sondaggio",
            'poll:strapline' => "%s",           
            'item:object:poll' => 'Sondaggio',
            'poll:question' => "Domande del sondaggio",
            'poll:responses' => "Possibili risposte (separate da virgole)",
            'poll:approvelist'=>"Sondaggi da approvare",
            'poll:mypolls'=>"I miei Sondaggi",
            'poll:displayyourpoll'=>"Questo widget visualizza i tuoi sondaggi",
            'poll:latestComunityPoll'=>"Ultimi sondaggi della comunint&agrave;",
            'poll:displaymostrecentpoll'=>"Visualizza gli ultimi sondaggi",
            'poll:saved:request'=>"Richiesta salvata in attesa di approvazione",
            'poll:enabled'=>"Sondaggio abilitato",
            'poll:saved'=>"Sondaggio salvato!",
            'poll:requests'=>"Richieste abilitazione sondaggi",
            'poll:enable:on'=>"Abilita",
            'poll:results'=>"Risultati del sondaggio",

        /**
         * poll widget
         **/    
            'poll:widget:label:displaynum' => "Quanti sondaggi vuoi visualizzare?",
            'poll:usepolladmin'=>"Moderazione sondaggi amministratore sito",
            'poll:usepolladmin:yes'=>"Si",
            'poll:usepolladmin:no'=>"No",
         /**
         * poll river
         **/
            
            //generic terms to use
            'poll:river:created' => "%s ha scritto",
            'poll:river:updated' => "%s ha caricato",
            'poll:river:posted' => "%s ha inserito",
            'poll:river:voted'=>"%s ha votato",
            
            //these get inserted into the river links to take the user to the entity
            'poll:river:create' => "un nuovo sondaggio - ",
            'poll:river:update' => "il sondaggio  - ",
            'poll:river:annotate' => "un commento sul sondaggio - ",
            'poll:river:annotate:create' => "un commento sul sondaggio - ",
            'poll:river:vote'=>"il sondaggio - ",
            


        /**
         * Status messages
         */
    
            'poll:posted' => "Il tuo sondaggio &egrave; stato inserito con successo.",
            'poll:responded' => "Grazie per la risposta, il tuo voto &egrave; stato registrato.",
            'poll:deleted' => "Il tuo sondaggio &egrave; stato eliminato con successo.",
            'poll:totalvotes' => "Numero totale di voti: ",
            'poll:voted' => "Hai espresso il tuo voto per questo sondaggio. Grazie per aver partecipato.",
            
    
        /**
         * Error messages
         */
    
            'poll:save:failure' => "Il tuo sondaggio non pu&ograve essere salvato. Riprova.",
            'poll:blank' => "Siamo spiacenti; &egrave; necessario specificare sia le domande che le risposte per creare un sondaggio.",
            'poll:notfound' => "Siamo spiacenti; impossibile trovare il sondaggio specificato.",
            'poll:notdeleted' => "Siamo spiacenti; impossibile eliminare questo sondaggio.", 
            'polls:nonefound' => "Nessun sondaggio trovato da %s",
            'poll:group' => "Sondaggi del Gruppo",
            'poll:add'=>"Aggiungi Sondaggi",
'response'=>"risposta",
'responses'=>"risposte",
'poll:polls' => "Sondaggi di"
);
                    
    add_translation("it",$italian);



?>