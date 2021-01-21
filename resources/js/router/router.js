import Router from 'vue-router'

import Front from '../components/Pages/Front/Front.vue'

import MyPage from '../components/Pages/MyPage/MyPage.vue'
import MyPageSetting from '../components/Pages/MyPage/MyPageSetting.vue'
import MyPageDeleteAccount from '../components/Pages/MyPage/MyPageDeleteAccount.vue'

import Document from '../components/Pages/Document/Document.vue'
import DocumentIntention from '../components/Pages/Document/DocumentIntention.vue'
import DocumentOutline from '../components/Pages/Document/DocumentOutline.vue'
import DocumentConcept from '../components/Pages/Document/DocumentConcept.vue'
import DocumentCover from '../components/Pages/Document/DocumentCover.vue'
import DocumentVote from '../components/Pages/Document/DocumentVote.vue'
import DocumentCommunitiesAndProjects from '../components/Pages/Document/DocumentCommunitiesAndProjects.vue'
import DocumentWatch from '../components/Pages/Document/DocumentWatch.vue'
import DocumentPriority from '../components/Pages/Document/DocumentPriority.vue'
import DocumentSupporters from '../components/Pages/Document/DocumentSupporters.vue'
import DocumentOpenSource from '../components/Pages/Document/DocumentOpenSource.vue'
import DocumentNotes from '../components/Pages/Document/DocumentNotes.vue'
import DocumentTermsOfUse from '../components/Pages/Document/DocumentTermsOfUse.vue'
import DocumentPrivacyPolicy from '../components/Pages/Document/DocumentPrivacyPolicy.vue'

import ConceptList from '../components/Pages/Concept/ConceptList.vue'
import ConceptPage from '../components/Pages/Concept/ConceptPage.vue'

import CommunityPage from '../components/Pages/Community/CommunityPage.vue'
import CommunityPageAbout from '../components/Pages/Community/CommunityPageAbout.vue'
import CommunityPageMembers from '../components/Pages/Community/CommunityPageMembers.vue'
import CommunityPageLeave from '../components/Pages/Community/CommunityPageLeave.vue'
import CommunityProjects from '../components/Pages/Community/CommunityPageProjects.vue'

import ProjectPage from '../components/Pages/Project/ProjectPage.vue'
import ProjectPageAbout from '../components/Pages/Project/ProjectPageAbout.vue'

import ChannelPage from '../components/Assets/Channel/ChannelPage.vue'

import NotFound from '../components/Pages/NotFound/NotFound.vue'

export default new Router({
    mode: 'history',
    routes: [{
            path: '',
            component: Front
        },
        {
            path: '/document',
            component: Document,
            children: [{
                    path: 'outline',
                    component: DocumentOutline
                },
                {
                    path: 'intention',
                    component: DocumentIntention
                },
                {
                    path: 'concept',
                    component: DocumentConcept
                },
                {
                    path: 'cover',
                    component: DocumentCover
                },
                {
                    path: 'vote',
                    component: DocumentVote
                },
                {
                    path: 'priority',
                    component: DocumentPriority
                },
                {
                    path: 'communities-and-projects',
                    component: DocumentCommunitiesAndProjects
                },
                {
                    path: 'watch',
                    component: DocumentWatch
                },
                {
                    path: 'supporters',
                    component: DocumentSupporters
                },
                {
                    path: 'open-source',
                    component: DocumentOpenSource
                },
                {
                    path: 'notes',
                    component: DocumentNotes
                },
                {
                    path: 'terms-of-use',
                    component: DocumentTermsOfUse
                },
                {
                    path: 'privacy-policy',
                    component: DocumentPrivacyPolicy
                }
            ]
        },
        {
            path: '/mypage',
            component: MyPage,
            props: true,
            meta: {
                requiresAuth: true
            },
            children: [{
                    path: '',
                    component: MyPageSetting
                },
                {
                    path: 'delete-account',
                    component: MyPageDeleteAccount
                }
            ]
        },
        {
            path: '/concepts/:page',
            component: ConceptList,
            props: true
        },
        {
            path: '/concept/:concept_id',
            component: ConceptPage,
            props: true
        },
        {
            path: '/community/:concept_id',
            component: CommunityPage,
            props: true,
            meta: {
                requiresAuth: true
            },
            children: [{
                    path: '',
                    component: CommunityPageAbout
                },
                {
                    path: 'projects',
                    component: CommunityProjects
                },
                {
                    path: 'members',
                    component: CommunityPageMembers
                },
                {
                    path: 'leave',
                    component: CommunityPageLeave
                },
                {
                    path: 'channel/:channel_id',
                    component: ChannelPage
                },
            ]
        },
        {
            path: '/project/:concept_id',
            component: ProjectPage,
            props: true,
            meta: {
                requiresAuth: true
            },
            children: [{
                    path: '',
                    component: ProjectPageAbout
                },
                {
                    path: 'projects',
                    component: CommunityProjects
                },
                {
                    path: 'channel/:channel_id',
                    component: ChannelPage
                },
            ]
        },
        {
            path: '/register',
            component: NotFound
        },
        {
            path: '/login',
            component: NotFound
        },
        {
            path: '*',
            component: NotFound,
        }
    ]
});
