'use client';

import Button from '@/components/Button';
import { useAuth } from "@/hooks/auth";
import { usePathname, useSearchParams } from "next/navigation";
import { useState } from 'react';

const Page = () => {
  const pathname = usePathname();
  const params   = useSearchParams();
  const [ errors, setErrors ] = useState([]);
  const { confirm, logout } = useAuth({middleware: "auth", redirectIfAuthenticated: "/dashboard?verified=1"});

  return (
    <>
      <div className="mb-4 text-sm text-gray-600">
        Confirm email address by clicking the button below.
      </div>
      {errors.length > 0 && (
        <div className="mb-4 font-medium text-sm text-red-600">
            {errors.map(error => error)}
        </div>
      )}
      <div className="mt-4 flex items-center justify-between">
        <Button onClick={() => confirm({ url: `${pathname}?${params.toString()}`, setErrors })}>
            Confirm Email
        </Button>
        <button
            type="button"
            className="underline text-sm text-gray-600 hover:text-gray-900"
            onClick={logout}>
            Logout
        </button>
      </div>
    </>
  );
};

export default Page;