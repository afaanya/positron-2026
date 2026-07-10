'use strict';
/* ══════════════════════════════════════════════════════
   MENTOR PORTAL — entry point
   Wires up the SPA modules and exposes the functions used by
   inline on* attributes in the Blade partials.
   ══════════════════════════════════════════════════════ */

import { S } from './mentor/state.js';

import {
    goTo,
    toggleSidebar,
    toggleProfile,
    openProfileModal,
    closeModal,
    doLogout,
} from './mentor/nav.js';

import {
    setPill,
    render,
    exportCSV,
    goPage,
    lihat,
    tutupBiodata,
    toggleEditDd,
    setStatus,
} from './mentor/dashboard.js';

import {
    beriNilai,
    switchSection,
    calcTotal,
    validateScore,
    simpan,
    riwayat,
} from './mentor/assessment.js';

import { showToast } from './mentor/utils.js';


document.addEventListener('DOMContentLoaded', () => {

    const M = window.__MENTOR__ || {};

    S.auth = true;

    if (M.user) {
        S.user = M.user;

        const pu = document.getElementById('profUser');

        if (pu) {
            pu.textContent = M.user;
        }
    }

    render();
    goTo('page-dashboard');
});


Object.assign(window, {

    // Navigation
    goTo,
    toggleSidebar,
    toggleProfile,
    openProfileModal,
    closeModal,
    doLogout,

    // Dashboard
    setPill,
    render,
    exportCSV,
    goPage,
    lihat,
    tutupBiodata,
    toggleEditDd,
    setStatus,

    // Assessment
    beriNilai,
    switchSection,
    calcTotal,
    validateScore,
    simpan,
    riwayat,

    // Utils
    showToast,

});