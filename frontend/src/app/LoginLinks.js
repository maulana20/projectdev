"use client";

import Link from "next/link";
import { useSession, useUser } from "@clerk/nextjs";
import { SignInButton } from "@clerk/nextjs";

const LoginLinks = () => {
  const { user } = useUser();
  const { session } = useSession();
  return (
    <div className="hidden fixed top-0 right-0 px-6 py-4 sm:block">
      {user || session ? (
        <Link href="/dashboard" className="ml-4 text-sm text-gray-700 underline">Dashboard</Link>
      ) : (
        <SignInButton />
      )}
    </div>
  );
};

export default LoginLinks;