import Router from 'vue-router'

import Front from '../components/Pages/Front/Front.vue'

import MyPage from '../components/Pages/MyPage/MyPage.vue'
import MyPageJoinedCommunity from '../components/Pages/MyPage/MyPageJoinedCommunity.vue'
import MyPageSetting from '../components/Pages/MyPage/MyPageSetting.vue'

import Document from '../components/Pages/Document/Document.vue'
import DocumentConcept from '../components/Pages/Document/DocumentConcept.vue'
import DocumentCover from '../components/Pages/Document/DocumentCover.vue'
import DocumentVote from '../components/Pages/Document/DocumentVote.vue'
import DocumentPriority from '../components/Pages/Document/DocumentPriority.vue'
import DocumentNotes from '../components/Pages/Document/DocumentNotes.vue'
import DocumentTerms from '../components/Pages/Document/DocumentTerms.vue'

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
                    path: 'notes',
                    component: DocumentNotes
                },
                {
                    path: 'terms',
                    component: DocumentTerms
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
                    component: MyPageJoinedCommunity
                },
                {
                    path: 'setting',
                    component: MyPageSetting
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
