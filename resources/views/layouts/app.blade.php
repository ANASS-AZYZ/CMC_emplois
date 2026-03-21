<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMC Planning</title>
    <link rel="icon" type="image/png" sizes="64x64" href="/favicon-cmcm.png">
    <script>
        (function () {
            try {
                var mode = localStorage.getItem('cmc_theme_mode') || 'system';
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                var shouldUseDark = mode === 'dark' || (mode === 'system' && prefersDark);
                if (shouldUseDark) {
                    document.documentElement.classList.add('theme-dark-preload');
                }
            } catch (e) {}
        })();
    </script>
    <style>
        :root {
            --app-bg: #f4f6fb;
            --app-surface: #ffffff;
            --app-surface-soft: #eef2ff;
            --app-text: #0f172a;
            --app-muted: #475569;
            --app-border: #dbe4f3;
            --app-accent: #4f46e5;
            --app-accent-strong: #2563eb;
            --app-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
            --sidebar-bg: #f8fafc;
            --sidebar-text: #1e293b;
            --sidebar-muted: #64748b;
            --sidebar-hover: #e2e8f0;
            --sidebar-active: #2563eb;
            --sidebar-border: #e2e8f0;
        }

        .theme-dark-preload body,
        body.theme-dark {
            --app-bg: #0b1220;
            --app-surface: #101827;
            --app-surface-soft: #1a2438;
            --app-text: #f8fafc;
            --app-muted: #d1d5db;
            --app-border: #253046;
            --app-accent: #f8fafc;
            --app-accent-strong: #ffffff;
            --app-shadow: 0 10px 24px rgba(0, 0, 0, 0.45);
            --sidebar-bg: #0a1020;
            --sidebar-text: #ffffff;
            --sidebar-muted: #d1d5db;
            --sidebar-hover: #1a2438;
            --sidebar-active: #e5edf8;
            --sidebar-border: #253046;
        }

        body {
            background: var(--app-bg) !important;
            color: var(--app-text);
        }

        .bg-white,
        nav,
        header {
            background: var(--app-surface) !important;
            color: var(--app-text) !important;
            border-color: var(--app-border) !important;
        }

        .bg-gray-100,
        .bg-gray-50 {
            background: var(--app-bg) !important;
        }

        .text-gray-900,
        .text-gray-800,
        .text-gray-700,
        .text-gray-600,
        .text-gray-500 {
            color: var(--app-muted) !important;
        }

        .text-blue-600,
        .text-blue-500,
        .text-indigo-600 {
            color: var(--app-accent-strong) !important;
        }

        .border,
        .border-gray-100,
        .border-gray-200,
        .border-gray-300 {
            border-color: var(--app-border) !important;
        }

        .shadow,
        .shadow-sm,
        .shadow-lg {
            box-shadow: var(--app-shadow) !important;
        }

        .bg-blue-50 {
            background: var(--app-surface-soft) !important;
        }

        .sidebar-shell {
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            border-right: 1px solid var(--sidebar-border);
        }

        .sidebar-brand {
            color: var(--app-accent-strong);
        }

        .sidebar-section {
            color: var(--sidebar-muted);
        }

        .sidebar-link {
            color: var(--sidebar-text);
        }

        .sidebar-link:hover {
            background: transparent !important;
            color: inherit !important;
        }

        .sidebar-link-active {
            background: var(--sidebar-active);
            color: #ffffff !important;
        }

        body.theme-dark .sidebar-link-active {
            background: #e5edf8;
            color: #000000 !important;
        }

        .ui-icon-btn {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            border: 1px solid #cbd5e1;
            background: #fff;
            font-size: 14px;
            line-height: 1;
        }

        .ui-icon-btn svg,
        .ui-icon-btn i {
            width: 18px !important;
            height: 18px !important;
            font-size: 18px !important;
        }

        .ui-search-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .ui-search-icon {
            position: absolute;
            left: 12px;
            width: 16px;
            height: 16px;
            color: #64748b;
            pointer-events: none;
        }

        .ui-search-input {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 9999px;
            background: #ffffff;
            color: #0f172a;
            height: 32px;
            padding: 0 66px 0 32px;
            font-size: 12px;
            font-weight: 600;
        }

        .ui-search-shortcut {
            position: absolute;
            right: 10px;
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
        }

        .ui-avatar-fallback {
            width: 36px;
            height: 36px;
            min-width: 36px;
            min-height: 36px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%);
            border: 1px solid #93c5fd;
            color: #1e3a8a;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            text-transform: uppercase;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        body.theme-dark .ui-icon-btn {
            border-color: var(--app-border);
            background: var(--app-surface-soft);
            color: var(--app-text);
        }

        body.theme-dark .ui-search-input {
            border-color: var(--app-border);
            background: var(--app-surface-soft);
            color: var(--app-text);
        }

        body.theme-dark .ui-search-shortcut,
        body.theme-dark .ui-search-icon {
            color: #94a3b8;
        }

        body.theme-dark .ui-avatar-fallback {
            background: linear-gradient(135deg, #334155 0%, #475569 100%);
            border-color: #64748b;
            color: #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .ui-lang-wrap { position: relative; }

        .ui-lang-menu {
            position: absolute;
            top: 42px;
            right: 0;
            width: 128px;
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 6px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
            z-index: 40;
        }

        .ui-lang-item {
            width: 100%;
            text-align: left;
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
        }

        .ui-lang-item:hover {
            background: transparent !important;
            color: inherit !important;
        }
        .ui-lang-item.active { background: #dbeafe; color: #1e3a8a; }

        body.theme-dark .ui-lang-menu {
            background: var(--app-surface);
            border-color: var(--app-border);
            box-shadow: var(--app-shadow);
        }

        body.theme-dark .ui-lang-item { color: #e2e8f0; }
        body.theme-dark .ui-lang-item:hover { background: var(--app-surface-soft); }
        body.theme-dark .ui-lang-item.active { background: #ffffff; color: #000000; }

        .ui-hidden { display: none !important; }

        
        .sidebar-link:not(.sidebar-link-active):hover {
            background: transparent !important;
            color: inherit !important;
        }

        .ui-lang-item:hover {
            background: transparent !important;
            color: inherit !important;
        }

        a:hover,
        button:hover {
            transform: none !important;
            filter: none !important;
            box-shadow: inherit !important;
        }

        a,
        button {
            transition: none !important;
        }

        [class*="hover\\:bg-"]:hover,
        [class*="hover\\:text-"]:hover,
        [class*="hover\\:border-"]:hover,
        [class*="hover\\:shadow"]:hover,
        [class*="hover\\:underline"]:hover {
            background-color: transparent !important;
            color: currentColor !important;
            border-color: currentColor !important;
            box-shadow: none !important;
            text-decoration: none !important;
        }

        [class*="focus\\:bg-"]:focus,
        [class*="focus\\:text-"]:focus,
        [class*="focus\\:border-"]:focus,
        [class*="active\\:bg-"]:active,
        [class*="active\\:text-"]:active,
        [class*="active\\:border-"]:active {
            background-color: transparent !important;
            color: currentColor !important;
            border-color: currentColor !important;
            box-shadow: none !important;
        }

        
        body.theme-dark select,
        body.theme-dark input,
        body.theme-dark textarea {
            background: #ffffff !important;
            color: #0f172a !important;
            border-color: #94a3b8 !important;
        }

        body.theme-dark select option {
            background: #ffffff;
            color: #0f172a;
        }

        @media (max-width: 768px) {
            html,
            body {
                overflow-x: hidden;
            }

            main {
                padding: 10px !important;
            }

            .ui-search-wrap {
                width: 100% !important;
            }

            .ui-search-input {
                height: 34px;
                font-size: 13px;
            }

            .ui-search-shortcut {
                font-size: 9px;
            }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        @auth
            <aside class="flex-shrink-0">
                @include('layouts.sidebar')
            </aside>
        @endauth

        <div class="flex-1 flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var themeToggle = document.getElementById('ui-theme-toggle');
            var langToggle = document.getElementById('ui-lang-toggle');
            var langMenu = document.getElementById('ui-lang-menu');
            var langItems = document.querySelectorAll('.ui-lang-item');
            var searchInputs = document.querySelectorAll('#ui-nav-search, #ui-nav-search-mobile, #ui-sidebar-search');
            var sidebarLinks = document.querySelectorAll('.sidebar-link');
            var notificationTrigger = document.getElementById('ui-notification-trigger');
            function detectSystemLanguage() {
                var navLang = ((navigator.language || navigator.userLanguage || 'en') + '').toLowerCase();
                if (navLang.indexOf('ar') === 0) {
                    return 'ar';
                }
                if (navLang.indexOf('fr') === 0) {
                    return 'fr';
                }
                return 'en';
            }

            var currentLang = localStorage.getItem('cmc_lang') || detectSystemLanguage();
            var themeMode = localStorage.getItem('cmc_theme_mode') || 'system';
            var notificationInFlight = false;

            var dict = {
                fr: {
                    navDashboard: 'Tableau de Bord',
                    navGroupTimetable: 'Emplois Groupe',
                    navMyTimetable: 'Mon Emploi',
                    navConsultation: 'Consultation Emploi',
                    navProfile: 'Profil',
                    navLogout: 'Deconnexion',
                    navSettings: 'Parametres',
                    navSearchPlaceholder: 'Rechercher...',
                    sideResources: 'Ressources',
                    sideGroups: 'Groupes',
                    sideRooms: 'Salles',
                    sideTrainers: 'Formateurs',
                    sideMessages: 'Messages',
                    sidePlanning: 'Planning',
                    sideManageSessions: 'Gestion Seances',
                    sideGroupTimetables: 'Emplois Groupe',
                    sideContactAdmin: 'Contacter Admin',
                    sideFormateurSpace: 'Espace formateur',
                    sidePreferences: 'Preferences',
                    sideSettings: 'Parametres',
                    settingsTitle: 'Parametres',
                    settingsPasswordNav: 'Changer le mot de passe',
                    settingsThemeNav: 'Mode d\'affichage',
                    settingsLanguageNav: 'Langue',
                    settingsThemeTitle: 'Mode d\'affichage',
                    settingsThemeHelp: 'Par defaut, le mode suit les preferences de votre systeme.',
                    settingsThemeLabel: 'Theme',
                    themeOptionSystem: 'Par defaut (systeme)',
                    themeOptionDark: 'Dark mode',
                    themeOptionLight: 'White mode',
                    settingsLanguageTitle: 'Langue',
                    settingsLanguageHelp: 'Choisissez la langue de l\'interface.',
                    settingsLanguageLabel: 'Language',
                    showPasswordBtn: 'Afficher',
                    hidePasswordBtn: 'Masquer',
                    dashboardTitle: 'Tableau de Bord - CMC',
                    statTrainers: 'Formateurs',
                    statRooms: 'Salles',
                    statGroups: 'Groupes',
                    statSessions: 'Seances',
                    welcomePrefix: 'Bienvenue,' ,
                    adminSpaceText: 'Vous etes dans l\'espace d\'administration du planning CMC.',
                    emploisGroupsTitle: 'Emplois des Groupes',
                    filiereLabel: 'Filiere',
                    groupeLabel: 'Groupe',
                    showBtn: 'Afficher',
                    printEmploisBtn: 'Imprimer emplois',
                    selectPrompt: 'Selectionner',
                    emptyPlanningMsg: 'Veuillez selectionner un filtre pour afficher le planning.',
                    dayHourHeader: 'Jour / Horaire',
                    trainerNameLabel: 'Nom du Formateur',
                    weeklyHoursLabel: 'Masse Horaire Hebdomadaire',
                    trainingYearLabel: 'Annee de Formation',
                    printTimetableBtn: 'Imprimer l\'emploi du temps',
                    groupLabelMeta: 'Groupe',
                    formateurLabel: 'Formateur',
                    salleLabel: 'Salle',
                    dayMonday: 'Lundi',
                    dayTuesday: 'Mardi',
                    dayWednesday: 'Mercredi',
                    dayThursday: 'Jeudi',
                    dayFriday: 'Vendredi',
                    daySaturday: 'Samedi',
                    contactAdminTitle: 'Contacter Admin',
                    proEmailLabel: 'Email Professionnel',
                    subjectLabel: 'Sujet',
                    messageLabel: 'Message',
                    subjectPlaceholder: 'Ex: Demande modification emploi',
                    messagePlaceholder: 'Ecrire votre message pour l\'admin...',
                    sendToAdminBtn: 'Envoyer a Admin',
                    errorsHeading: 'Kaynin akhta2:',
                    manageGroupsTitle: 'Gestion des Groupes',
                    manageRoomsTitle: 'Gestion des Salles',
                    manageTrainersTitle: 'Gestion des Formateurs',
                    globalPlanningTitle: 'Planning Global',
                    messagesTrainersTitle: 'Messages Formateurs',
                    addGroupBtn: '+ Ajouter un Groupe',
                    addRoomBtn: '+ Ajouter une Salle',
                    newTrainerBtn: '+ Nouveau Formateur',
                    scheduleSessionBtn: '+ Planifier une seance',
                    addTrainerTitle: 'Ajouter un Nouveau Formateur',
                    editTrainerTitle: 'Modifier Formateur :',
                    addRoomTitle: 'Ajouter une Salle',
                    editRoomTitle: 'Modifier la Salle :',
                    addGroupTitle: 'Ajouter un Groupe',
                    editGroupTitle: 'Modifier le Groupe :',
                    scheduleSessionTitle: 'Planifier une Seance',
                    editSessionTitle: 'Modifier la Seance',
                    matriculeLabel: 'Matricule',
                    fullNameLabel: 'Nom Complet',
                    emailLabel: 'Email',
                    specialityLabel: 'Specialite',
                    nomLabel: 'Nom',
                    prenomLabel: 'Prenom',
                    phoneLabel: 'Telephone',
                    accountPasswordLabel: 'Mot de passe du compte :',
                    passwordConfirmLabel: 'Confirmation mot de passe :',
                    passwordPlaceholder: 'Definir un mot de passe',
                    passwordConfirmPlaceholder: 'Confirmer le mot de passe',
                    changePasswordOptionalLabel: 'Changer le Mot de passe (Optionnel) :',
                    keepPasswordPlaceholder: 'Laisser vide pour ne pas changer',
                    saveTrainerBtn: 'Enregistrer le Formateur',
                    saveChangesBtn: 'Enregistrer les modifications',
                    saveBtn: 'Enregistrer',
                    savePlanningBtn: 'Enregistrer la Planification',
                    groupCodeLabel: 'Code du Groupe',
                    groupCodeExampleLabel: 'Code du Groupe (ex: DEVOWFS202)',
                    yearLabel: 'Annee',
                    firstYearLabel: '1ere annee',
                    secondYearLabel: '2eme annee',
                    codeExampleRoomLabel: 'Code (ex: SC-02, SM-03)',
                    roomTypeLabel: 'Type de Salle',
                    capacityOptionalLabel: 'Capacite (Optionnel)',
                    roomTypeCourseLabel: 'Salle de cours (SC)',
                    roomTypeMultimediaLabel: 'Salle Multimedia (SM)',
                    codeUniqueLabel: 'Code Unique',
                    codeRoomLabel: 'Code (SC/SM)',
                    dayLabel: 'Jour',
                    slotLabel: 'Creneau',
                    slotDurationLabel: 'Creneau Horaire (2h30)',
                    noMessagesYet: 'Aucun message recu pour le moment.',
                    fromLabel: 'De:',
                    trainerFallback: 'Formateur',
                    markReadBtn: 'Marquer comme lu',
                    readLabel: 'Lu',
                    formErrorsTitle: 'Des erreurs existent dans le formulaire :',
                    cancelBtn: 'Annuler',
                    editBtn: 'Modifier',
                    deleteBtn: 'Supprimer',
                    actionsLabel: 'Actions',
                    codeLabel: 'Code',
                    typeLabel: 'Type',
                    capacityLabel: 'Capacite',
                    saveRoomBtn: 'Enregistrer la Salle',
                    inboxTab: 'Boite de reception',
                    archiveTab: 'Archive',
                    noInboxMessages: 'Aucun nouveau message pour le moment.',
                    noArchivedMessages: 'Aucun message archive pour le moment.',
                    confirmDeleteRoom: 'Supprimer cette salle ?',
                    confirmDeleteGeneric: 'Supprimer ?',
                    confirmCancelSession: 'Annuler ?',
                    profilePageTitle: 'Profil',
                    profilePhotoHelp: 'Cliquez pour ajouter ou modifier la photo',
                    profileRemovePhoto: 'Supprimer la photo',
                    profileNameLabel: 'Nom',
                    profileEmailLabel: 'Email',
                    profileSaveBtn: 'Enregistrer',
                    profilePasswordTitle: 'Mot de passe',
                    profilePasswordHelp: 'Modifiez votre mot de passe.',
                    profileCurrentPasswordLabel: 'Mot de passe actuel',
                    profileNewPasswordLabel: 'Nouveau mot de passe',
                    profileConfirmPasswordLabel: 'Confirmer le mot de passe',
                    profileSavePasswordBtn: 'Enregistrer le mot de passe',
                    profileLockedInfo: 'Le nom et l\'email sont verrouilles pour le compte formateur.',
                    notificationsTitle: 'Notifications',
                    noNotifications: 'Aucune notification pour le moment.',
                    statusAbsent: 'ABSENT',
                    statusDistance: 'A distance',
                    savePdfBtn: 'Installer PDF'
                },
                en: {
                    navDashboard: 'Dashboard',
                    navGroupTimetable: 'Group Timetables',
                    navMyTimetable: 'My Timetable',
                    navConsultation: 'Timetable Consultation',
                    navProfile: 'Profile',
                    navLogout: 'Log Out',
                    navSettings: 'Settings',
                    navSearchPlaceholder: 'Search...',
                    sideResources: 'Resources',
                    sideGroups: 'Groups',
                    sideRooms: 'Rooms',
                    sideTrainers: 'Trainers',
                    sideMessages: 'Messages',
                    sidePlanning: 'Planning',
                    sideManageSessions: 'Manage Sessions',
                    sideGroupTimetables: 'Group Timetables',
                    sideContactAdmin: 'Contact Admin',
                    sideFormateurSpace: 'Trainer space',
                    sidePreferences: 'Preferences',
                    sideSettings: 'Settings',
                    settingsTitle: 'Settings',
                    settingsPasswordNav: 'Change password',
                    settingsThemeNav: 'Display mode',
                    settingsLanguageNav: 'Language',
                    settingsThemeTitle: 'Display mode',
                    settingsThemeHelp: 'By default, the app follows your system theme.',
                    settingsThemeLabel: 'Theme',
                    themeOptionSystem: 'Default (system)',
                    themeOptionDark: 'Dark mode',
                    themeOptionLight: 'White mode',
                    settingsLanguageTitle: 'Language',
                    settingsLanguageHelp: 'Choose the interface language.',
                    settingsLanguageLabel: 'Language',
                    showPasswordBtn: 'Show',
                    hidePasswordBtn: 'Hide',
                    dashboardTitle: 'Dashboard - CMC',
                    statTrainers: 'Trainers',
                    statRooms: 'Rooms',
                    statGroups: 'Groups',
                    statSessions: 'Sessions',
                    welcomePrefix: 'Welcome,',
                    adminSpaceText: 'You are in the CMC planning administration space.',
                    emploisGroupsTitle: 'Group Timetables',
                    filiereLabel: 'Program',
                    groupeLabel: 'Group',
                    showBtn: 'Show',
                    printEmploisBtn: 'Print timetable',
                    selectPrompt: 'Select',
                    emptyPlanningMsg: 'Please select a filter to display the timetable.',
                    dayHourHeader: 'Day / Time',
                    trainerNameLabel: 'Trainer Name',
                    weeklyHoursLabel: 'Weekly Hours',
                    trainingYearLabel: 'Training Year',
                    printTimetableBtn: 'Print timetable',
                    groupLabelMeta: 'Group',
                    formateurLabel: 'Trainer',
                    salleLabel: 'Room',
                    dayMonday: 'Monday',
                    dayTuesday: 'Tuesday',
                    dayWednesday: 'Wednesday',
                    dayThursday: 'Thursday',
                    dayFriday: 'Friday',
                    daySaturday: 'Saturday',
                    contactAdminTitle: 'Contact Admin',
                    proEmailLabel: 'Professional Email',
                    subjectLabel: 'Subject',
                    messageLabel: 'Message',
                    subjectPlaceholder: 'Ex: Timetable change request',
                    messagePlaceholder: 'Write your message to admin...',
                    sendToAdminBtn: 'Send to Admin',
                    errorsHeading: 'There are errors:',
                    manageGroupsTitle: 'Group Management',
                    manageRoomsTitle: 'Room Management',
                    manageTrainersTitle: 'Trainer Management',
                    globalPlanningTitle: 'Global Planning',
                    messagesTrainersTitle: 'Trainer Messages',
                    addGroupBtn: '+ Add Group',
                    addRoomBtn: '+ Add Room',
                    newTrainerBtn: '+ New Trainer',
                    scheduleSessionBtn: '+ Schedule Session',
                    addTrainerTitle: 'Add New Trainer',
                    editTrainerTitle: 'Edit Trainer:',
                    addRoomTitle: 'Add Room',
                    editRoomTitle: 'Edit Room:',
                    addGroupTitle: 'Add Group',
                    editGroupTitle: 'Edit Group:',
                    scheduleSessionTitle: 'Schedule Session',
                    editSessionTitle: 'Edit Session',
                    matriculeLabel: 'ID Number',
                    fullNameLabel: 'Full Name',
                    emailLabel: 'Email',
                    specialityLabel: 'Speciality',
                    nomLabel: 'Last Name',
                    prenomLabel: 'First Name',
                    phoneLabel: 'Phone',
                    accountPasswordLabel: 'Account Password:',
                    passwordConfirmLabel: 'Password Confirmation:',
                    passwordPlaceholder: 'Set a password',
                    passwordConfirmPlaceholder: 'Confirm password',
                    changePasswordOptionalLabel: 'Change Password (Optional):',
                    keepPasswordPlaceholder: 'Leave empty to keep unchanged',
                    saveTrainerBtn: 'Save Trainer',
                    saveChangesBtn: 'Save Changes',
                    saveBtn: 'Save',
                    savePlanningBtn: 'Save Planning',
                    groupCodeLabel: 'Group Code',
                    groupCodeExampleLabel: 'Group Code (ex: DEVOWFS202)',
                    yearLabel: 'Year',
                    firstYearLabel: '1st year',
                    secondYearLabel: '2nd year',
                    codeExampleRoomLabel: 'Code (ex: SC-02, SM-03)',
                    roomTypeLabel: 'Room Type',
                    capacityOptionalLabel: 'Capacity (Optional)',
                    roomTypeCourseLabel: 'Classroom (SC)',
                    roomTypeMultimediaLabel: 'Multimedia Room (SM)',
                    codeUniqueLabel: 'Unique Code',
                    codeRoomLabel: 'Code (SC/SM)',
                    dayLabel: 'Day',
                    slotLabel: 'Slot',
                    slotDurationLabel: 'Time Slot (2h30)',
                    noMessagesYet: 'No messages received yet.',
                    fromLabel: 'From:',
                    trainerFallback: 'Trainer',
                    markReadBtn: 'Mark as read',
                    readLabel: 'Read',
                    formErrorsTitle: 'There are form errors:',
                    cancelBtn: 'Cancel',
                    editBtn: 'Edit',
                    deleteBtn: 'Delete',
                    actionsLabel: 'Actions',
                    codeLabel: 'Code',
                    typeLabel: 'Type',
                    capacityLabel: 'Capacity',
                    saveRoomBtn: 'Save Room',
                    inboxTab: 'Inbox',
                    archiveTab: 'Archive',
                    noInboxMessages: 'No new messages at the moment.',
                    noArchivedMessages: 'No archived messages yet.',
                    confirmDeleteRoom: 'Delete this room?',
                    confirmDeleteGeneric: 'Delete?',
                    confirmCancelSession: 'Cancel?',
                    profilePageTitle: 'Profile',
                    profilePhotoHelp: 'Click to add or change photo',
                    profileRemovePhoto: 'Remove photo',
                    profileNameLabel: 'Name',
                    profileEmailLabel: 'Email',
                    profileSaveBtn: 'Save',
                    profilePasswordTitle: 'Password',
                    profilePasswordHelp: 'Update your password.',
                    profileCurrentPasswordLabel: 'Current password',
                    profileNewPasswordLabel: 'New password',
                    profileConfirmPasswordLabel: 'Confirm password',
                    profileSavePasswordBtn: 'Save password',
                    profileLockedInfo: 'Name and email are locked for trainer account.',
                    notificationsTitle: 'Notifications',
                    noNotifications: 'No notifications at the moment.',
                    statusAbsent: 'ABSENT',
                    statusDistance: 'Remote',
                    savePdfBtn: 'Save PDF'
                },
                ar: {
                    navDashboard: 'لوحة التحكم',
                    navGroupTimetable: 'جداول المجموعات',
                    navMyTimetable: 'جدولي',
                    navConsultation: 'استشارة الجداول',
                    navProfile: 'الملف الشخصي',
                    navLogout: 'تسجيل الخروج',
                    navSettings: 'الاعدادات',
                    navSearchPlaceholder: 'بحث...',
                    sideResources: 'الموارد',
                    sideGroups: 'المجموعات',
                    sideRooms: 'القاعات',
                    sideTrainers: 'المكونون',
                    sideMessages: 'الرسائل',
                    sidePlanning: 'التخطيط',
                    sideManageSessions: 'تدبير الحصص',
                    sideGroupTimetables: 'جداول المجموعات',
                    sideContactAdmin: 'مراسلة الادارة',
                    sideFormateurSpace: 'فضاء المكون',
                    sidePreferences: 'التفضيلات',
                    sideSettings: 'الاعدادات',
                    settingsTitle: 'الاعدادات',
                    settingsPasswordNav: 'تغيير كلمة المرور',
                    settingsThemeNav: 'وضع العرض',
                    settingsLanguageNav: 'اللغة',
                    settingsThemeTitle: 'وضع العرض',
                    settingsThemeHelp: 'افتراضيا يتم اتباع اعدادات النظام.',
                    settingsThemeLabel: 'الثيم',
                    themeOptionSystem: 'افتراضي (النظام)',
                    themeOptionDark: 'الوضع الداكن',
                    themeOptionLight: 'الوضع الفاتح',
                    settingsLanguageTitle: 'اللغة',
                    settingsLanguageHelp: 'اختر لغة الواجهة.',
                    settingsLanguageLabel: 'اللغة',
                    showPasswordBtn: 'اظهار',
                    hidePasswordBtn: 'اخفاء',
                    dashboardTitle: 'لوحة التحكم - CMC',
                    statTrainers: 'المكونون',
                    statRooms: 'القاعات',
                    statGroups: 'المجموعات',
                    statSessions: 'الحصص',
                    welcomePrefix: 'مرحبا،',
                    adminSpaceText: 'انت في فضاء ادارة تخطيط CMC.',
                    emploisGroupsTitle: 'جداول المجموعات',
                    filiereLabel: 'الشعبة',
                    groupeLabel: 'المجموعة',
                    showBtn: 'عرض',
                    printEmploisBtn: 'طباعة الجداول',
                    selectPrompt: 'اختر',
                    emptyPlanningMsg: 'المرجو اختيار فلتر لعرض استعمال الزمن.',
                    dayHourHeader: 'اليوم / التوقيت',
                    trainerNameLabel: 'اسم المكون',
                    weeklyHoursLabel: 'الحصة الاسبوعية',
                    trainingYearLabel: 'سنة التكوين',
                    printTimetableBtn: 'طباعة استعمال الزمن',
                    groupLabelMeta: 'المجموعة',
                    formateurLabel: 'المكون',
                    salleLabel: 'القاعة',
                    dayMonday: 'الاثنين',
                    dayTuesday: 'الثلاثاء',
                    dayWednesday: 'الاربعاء',
                    dayThursday: 'الخميس',
                    dayFriday: 'الجمعة',
                    daySaturday: 'السبت',
                    contactAdminTitle: 'مراسلة الادارة',
                    proEmailLabel: 'البريد المهني',
                    subjectLabel: 'الموضوع',
                    messageLabel: 'الرسالة',
                    subjectPlaceholder: 'مثال: طلب تعديل استعمال الزمن',
                    messagePlaceholder: 'اكتب رسالتك للادارة...',
                    sendToAdminBtn: 'ارسال الى الادارة',
                    errorsHeading: 'توجد اخطاء:',
                    manageGroupsTitle: 'تدبير المجموعات',
                    manageRoomsTitle: 'تدبير القاعات',
                    manageTrainersTitle: 'تدبير المكونين',
                    globalPlanningTitle: 'التخطيط العام',
                    messagesTrainersTitle: 'رسائل المكونين',
                    addGroupBtn: '+ اضافة مجموعة',
                    addRoomBtn: '+ اضافة قاعة',
                    newTrainerBtn: '+ مكون جديد',
                    scheduleSessionBtn: '+ برمجة حصة',
                    addTrainerTitle: 'اضافة مكون جديد',
                    editTrainerTitle: 'تعديل المكون :',
                    addRoomTitle: 'اضافة قاعة',
                    editRoomTitle: 'تعديل القاعة :',
                    addGroupTitle: 'اضافة مجموعة',
                    editGroupTitle: 'تعديل المجموعة :',
                    scheduleSessionTitle: 'برمجة حصة',
                    editSessionTitle: 'تعديل الحصة',
                    matriculeLabel: 'رقم التأجير',
                    fullNameLabel: 'الاسم الكامل',
                    emailLabel: 'البريد الالكتروني',
                    specialityLabel: 'التخصص',
                    nomLabel: 'النسب',
                    prenomLabel: 'الاسم',
                    phoneLabel: 'الهاتف',
                    accountPasswordLabel: 'كلمة مرور الحساب :',
                    passwordConfirmLabel: 'تأكيد كلمة المرور :',
                    passwordPlaceholder: 'حدد كلمة مرور',
                    passwordConfirmPlaceholder: 'تاكيد كلمة المرور',
                    changePasswordOptionalLabel: 'تغيير كلمة المرور (اختياري) :',
                    keepPasswordPlaceholder: 'اتركه فارغا اذا لم ترد التغيير',
                    saveTrainerBtn: 'حفظ المكون',
                    saveChangesBtn: 'حفظ التعديلات',
                    saveBtn: 'حفظ',
                    savePlanningBtn: 'حفظ البرمجة',
                    groupCodeLabel: 'رمز المجموعة',
                    groupCodeExampleLabel: 'رمز المجموعة (مثال: DEVOWFS202)',
                    yearLabel: 'السنة',
                    firstYearLabel: 'السنة الاولى',
                    secondYearLabel: 'السنة الثانية',
                    codeExampleRoomLabel: 'الرمز (مثال: SC-02, SM-03)',
                    roomTypeLabel: 'نوع القاعة',
                    capacityOptionalLabel: 'السعة (اختياري)',
                    roomTypeCourseLabel: 'قاعة درس (SC)',
                    roomTypeMultimediaLabel: 'قاعة متعددة الوسائط (SM)',
                    codeUniqueLabel: 'الرمز الفريد',
                    codeRoomLabel: 'الرمز (SC/SM)',
                    dayLabel: 'اليوم',
                    slotLabel: 'الفترة',
                    slotDurationLabel: 'الفترة الزمنية (2س30د)',
                    noMessagesYet: 'لا توجد رسائل حاليا.',
                    fromLabel: 'من:',
                    trainerFallback: 'مكون',
                    markReadBtn: 'وضع كمقروء',
                    readLabel: 'مقروء',
                    formErrorsTitle: 'توجد اخطاء في الاستمارة :',
                    cancelBtn: 'الغاء',
                    editBtn: 'تعديل',
                    deleteBtn: 'حذف',
                    actionsLabel: 'الاجراءات',
                    codeLabel: 'الرمز',
                    typeLabel: 'النوع',
                    capacityLabel: 'السعة',
                    saveRoomBtn: 'حفظ القاعة',
                    inboxTab: 'صندوق الوارد',
                    archiveTab: 'الارشيف',
                    noInboxMessages: 'لا توجد رسائل جديدة حاليا.',
                    noArchivedMessages: 'لا توجد رسائل في الارشيف حاليا.',
                    confirmDeleteRoom: 'حذف هذه القاعة؟',
                    confirmDeleteGeneric: 'حذف؟',
                    confirmCancelSession: 'الغاء؟',
                    profilePageTitle: 'الملف الشخصي',
                    profilePhotoHelp: 'انقر لإضافة أو تغيير الصورة',
                    profileRemovePhoto: 'حذف الصورة',
                    profileNameLabel: 'الاسم',
                    profileEmailLabel: 'البريد الإلكتروني',
                    profileSaveBtn: 'حفظ',
                    profilePasswordTitle: 'كلمة المرور',
                    profilePasswordHelp: 'تعديل كلمة المرور.',
                    profileCurrentPasswordLabel: 'كلمة المرور الحالية',
                    profileNewPasswordLabel: 'كلمة المرور الجديدة',
                    profileConfirmPasswordLabel: 'تأكيد كلمة المرور',
                    profileSavePasswordBtn: 'حفظ كلمة المرور',
                    profileLockedInfo: 'الاسم والبريد الالكتروني مقفلان لحساب المكون.',
                    notificationsTitle: 'الاشعارات',
                    noNotifications: 'لا توجد اشعارات حاليا.',
                    statusAbsent: 'غائب',
                    statusDistance: 'عن بعد',
                    savePdfBtn: 'حفظ PDF'
                }
            };

            function resolveDarkFromMode(mode) {
                if (mode === 'dark') {
                    return true;
                }
                if (mode === 'light') {
                    return false;
                }
                return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            }

            function applyTheme(mode) {
                themeMode = ['light', 'dark', 'system'].indexOf(mode) !== -1 ? mode : 'system';
                var dark = resolveDarkFromMode(themeMode);
                document.body.classList.toggle('theme-dark', dark);
                document.documentElement.classList.toggle('theme-dark-preload', dark);
                if (!dark) {
                    document.documentElement.classList.remove('theme-dark-preload');
                }
                localStorage.setItem('cmc_theme_mode', themeMode);
                localStorage.setItem('cmc_theme', dark ? 'dark' : 'light');
                if (themeToggle) {
                    themeToggle.textContent = themeMode === 'system' ? '🖥️' : (dark ? '☀️' : '🌙');
                }

                document.dispatchEvent(new CustomEvent('cmc-theme-mode-changed', {
                    detail: { mode: themeMode, isDark: dark }
                }));
            }

            function applyLanguage(lang) {
                currentLang = dict[lang] ? lang : 'en';
                localStorage.setItem('cmc_lang', currentLang);
                document.documentElement.setAttribute('lang', currentLang);
                document.documentElement.setAttribute('dir', currentLang === 'ar' ? 'rtl' : 'ltr');

                var labels = dict[currentLang];
                document.querySelectorAll('[data-i18n-nav]').forEach(function (el) {
                    var key = el.getAttribute('data-i18n-nav');
                    if (labels[key]) {
                        el.textContent = labels[key];
                    }
                });

                document.querySelectorAll('[data-i18n-app]').forEach(function (el) {
                    var key = el.getAttribute('data-i18n-app');
                    if (labels[key]) {
                        el.textContent = labels[key];
                    }
                });

                document.querySelectorAll('[data-i18n-app-placeholder]').forEach(function (el) {
                    var key = el.getAttribute('data-i18n-app-placeholder');
                    if (labels[key]) {
                        el.setAttribute('placeholder', labels[key]);
                    }
                });

                document.querySelectorAll('[data-i18n-nav-placeholder]').forEach(function (el) {
                    var key = el.getAttribute('data-i18n-nav-placeholder');
                    if (labels[key]) {
                        el.setAttribute('placeholder', labels[key]);
                    }
                });

                document.querySelectorAll('[data-i18n-confirm]').forEach(function (el) {
                    var key = el.getAttribute('data-i18n-confirm');
                    if (labels[key]) {
                        el.setAttribute('data-confirm-msg', labels[key]);
                    }
                });

                langItems.forEach(function (item) {
                    var active = item.getAttribute('data-lang') === currentLang;
                    item.classList.toggle('active', active);
                });

                document.dispatchEvent(new CustomEvent('cmc-language-changed', {
                    detail: { lang: currentLang }
                }));
            }

            if (themeToggle) {
                themeToggle.addEventListener('click', function () {
                    var next = themeMode === 'system'
                        ? (document.body.classList.contains('theme-dark') ? 'light' : 'dark')
                        : (themeMode === 'dark' ? 'light' : 'dark');
                    applyTheme(next);
                });
            }

            if (langToggle && langMenu) {
                langToggle.addEventListener('click', function () {
                    langMenu.classList.toggle('ui-hidden');
                });
            }

            langItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    applyLanguage(item.getAttribute('data-lang'));
                    if (langMenu) {
                        langMenu.classList.add('ui-hidden');
                    }
                });
            });

            document.addEventListener('click', function (e) {
                if (!langMenu || !langToggle) {
                    return;
                }
                if (!langMenu.contains(e.target) && !langToggle.contains(e.target)) {
                    langMenu.classList.add('ui-hidden');
                }
            });

            function filterSidebarSearch(rawQuery) {
                if (!sidebarLinks.length) {
                    return;
                }

                var query = (rawQuery || '').toLowerCase().trim();
                sidebarLinks.forEach(function (link) {
                    var text = (link.textContent || '').toLowerCase();
                    var show = !query || text.indexOf(query) !== -1;
                    link.style.display = show ? '' : 'none';
                });
            }

            searchInputs.forEach(function (input) {
                if (!input) {
                    return;
                }

                input.addEventListener('input', function () {
                    var value = input.value;
                    searchInputs.forEach(function (other) {
                        if (other !== input) {
                            other.value = value;
                        }
                    });
                    filterSidebarSearch(value);
                });
            });

            document.addEventListener('keydown', function (event) {
                if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 'k') {
                    event.preventDefault();
                    var target = document.getElementById('ui-nav-search')
                        || document.getElementById('ui-sidebar-search')
                        || document.getElementById('ui-nav-search-mobile');
                    if (target) {
                        target.focus();
                        target.select();
                    }
                }
            });

            document.addEventListener('cmc:set-theme-mode', function (event) {
                var mode = event.detail && event.detail.mode ? event.detail.mode : 'system';
                applyTheme(mode);
            });

            document.addEventListener('cmc:set-language', function (event) {
                var lang = event.detail && event.detail.lang ? event.detail.lang : 'en';
                applyLanguage(lang);
            });

            if (notificationTrigger) {
                notificationTrigger.addEventListener('click', function () {
                    var badge = document.getElementById('ui-notification-badge');
                    if (!badge || notificationInFlight) {
                        return;
                    }

                    var url = notificationTrigger.getAttribute('data-mark-read-url');
                    var csrf = notificationTrigger.getAttribute('data-csrf');
                    if (!url || !csrf) {
                        return;
                    }

                    notificationInFlight = true;

                    fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                        .then(function (response) {
                            if (!response.ok) {
                                throw new Error('mark-all-failed');
                            }

                            badge.remove();
                            document.querySelectorAll('.ui-notif-item').forEach(function (item) {
                                item.remove();
                            });

                            var emptyState = document.getElementById('ui-notif-empty');
                            if (emptyState) {
                                emptyState.classList.remove('hidden');
                            }
                        })
                        .catch(function () {
                        })
                        .finally(function () {
                            notificationInFlight = false;
                        });
                });
            }

            if (window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {
                    if (themeMode === 'system') {
                        applyTheme('system');
                    }
                });
            }

            applyTheme(themeMode);
            applyLanguage(currentLang);
            filterSidebarSearch('');
            document.documentElement.classList.remove('theme-dark-preload');
        });
    </script>
</body>
</html>