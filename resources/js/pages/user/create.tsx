import AppLayout from '@/layouts/app-layout'
import { BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/react'
import React from 'react'

export default function create() {

    const breadcrumbs: BreadcrumbItem[] =[
        {
            title:'Dashboard',
            href:'/dashboard'
        },
        {
            title:'User',
            href:'/users'
        }

    ]

  return (
   <AppLayout breadcrumbs={breadcrumbs}>

<Head title='User'/>
<h1 className='text-4xl text-center text-balance mt-2'>User</h1>


   </AppLayout>
  )
}
