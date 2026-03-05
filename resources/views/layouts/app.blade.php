<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMC Planning</title>
    <script>
        (function () {
            try {
                var theme = localStorage.getItem('cmc_theme') || 'light';
                if (theme === 'dark') {
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
            background: var(--sidebar-hover);
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
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            border: 1px solid #cbd5e1;
            background: #fff;
            font-size: 16px;
            line-height: 1;
        }

        body.theme-dark .ui-icon-btn {
            border-color: var(--app-border);
            background: var(--app-surface-soft);
            color: var(--app-text);
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

        .ui-lang-item:hover { background: #f1f5f9; }
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

        /* Static UI mode: disable hover visual changes */
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
            var currentLang = localStorage.getItem('cmc_lang') || 'en';

            var dict = {
                fr: {
                    navDashboard: 'Tableau de Bord',
                    navGroupTimetable: 'Emplois Groupe',
                    navMyTimetable: 'Mon Emploi',
                    navConsultation: 'Consultation Emploi',
                    navProfile: 'Profil',
                    navLogout: 'Deconnexion',
                    sideResources: 'Ressources',
                    sideGroups: 'Groupes',
                    sideRooms: 'Salles',
                    sideTrainers: 'Formateurs',
                    sideMessages: 'Messages',
                    sidePlanning: 'Planning',
                    sideManageSessions: 'Gestion Seances',
                    sideGroupTimetables: 'Emplois Groupe',
                    sideContactAdmin: 'Contacter Admin',
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
                    selectPrompt: '-- Selectionner --',
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
                    confirmCancelSession: 'Annuler ?'
                },
                en: {
                    navDashboard: 'Dashboard',
                    navGroupTimetable: 'Group Timetables',
                    navMyTimetable: 'My Timetable',
                    navConsultation: 'Timetable Consultation',
                    navProfile: 'Profile',
                    navLogout: 'Log Out',
                    sideResources: 'Resources',
                    sideGroups: 'Groups',
                    sideRooms: 'Rooms',
                    sideTrainers: 'Trainers',
                    sideMessages: 'Messages',
                    sidePlanning: 'Planning',
                    sideManageSessions: 'Manage Sessions',
                    sideGroupTimetables: 'Group Timetables',
                    sideContactAdmin: 'Contact Admin',
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
                    selectPrompt: '-- Select --',
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
                    confirmCancelSession: 'Cancel?'
                },
                ar: {
                    navDashboard: 'لوحة التحكم',
                    navGroupTimetable: 'جداول المجموعات',
                    navMyTimetable: 'جدولي',
                    navConsultation: 'استشارة الجداول',
                    navProfile: 'الملف الشخصي',
                    navLogout: 'تسجيل الخروج',
                    sideResources: 'الموارد',
                    sideGroups: 'المجموعات',
                    sideRooms: 'القاعات',
                    sideTrainers: 'المكونون',
                    sideMessages: 'الرسائل',
                    sidePlanning: 'التخطيط',
                    sideManageSessions: 'تدبير الحصص',
                    sideGroupTimetables: 'جداول المجموعات',
                    sideContactAdmin: 'مراسلة الادارة',
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
                    selectPrompt: '-- اختر --',
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
                    confirmCancelSession: 'الغاء؟'
                }
            };

            function applyTheme(theme) {
                var dark = theme === 'dark';
                document.body.classList.toggle('theme-dark', dark);
                localStorage.setItem('cmc_theme', dark ? 'dark' : 'light');
                if (themeToggle) {
                    themeToggle.textContent = dark ? '☀️' : '🌙';
                }
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
                    applyTheme(document.body.classList.contains('theme-dark') ? 'light' : 'dark');
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

            applyTheme(localStorage.getItem('cmc_theme') || 'light');
            applyLanguage(currentLang);
            document.documentElement.classList.remove('theme-dark-preload');
        });
    </script>
</body>
</html>