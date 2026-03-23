"use client";
import Link from "next/link";
import { useForm, SubmitHandler } from "react-hook-form";

type Inputs = {
  name: string;
  email: string;
  password: string;
};
type SubmitFormProps = {
  titleSpan: string;
  linkSpan: string;
  linkHref: string;
  buttonTitle: string;
  showEmail?: boolean;
};

export default function SubmitForm({
  titleSpan,
  linkSpan,
  linkHref,
  buttonTitle,
  showEmail = false,
}: SubmitFormProps) {
  const { register, handleSubmit } = useForm<Inputs>();
  const onSubmit: SubmitHandler<Inputs> = (data) => console.log(data);

  return (
    <form
      onSubmit={handleSubmit(onSubmit)}
      className="flex flex-col bg-indigo-300 font-sans shadow-sm px-12 py-4 gap-4 rounded-lg font-bold items-center"
    >
      <span className=" text-white text-[22px] pb-2">{titleSpan}</span>
      <div className="flex flex-col">
        <span className=" text-white text-[18px]">Логин</span>
        <input
          {...register("name")}
          className="focus:outline-none focus:ring-0 w-full  bg-white shadow-sm rounded-lg"
        />
      </div>
      {showEmail && (
        <div className="flex flex-col">
          <span className=" text-white text-[18px]">Email</span>
          <input
            {...register("email")}
            className="focus:outline-none focus:ring-0 w-full  bg-white shadow-sm  rounded-lg"
          />
        </div>
      )}
      <div className="flex flex-col">
        <span className="font-bold text-white text-[18px]">Пароль</span>
        <input
          {...register("password")}
          className="focus:outline-none focus:ring-0 w-full  bg-white shadow-sm  rounded-lg"
        />
      </div>
      <input
        type="submit"
        value={buttonTitle}
        className="text-white w-full text-[18px]  hover:text-[#F9F9F9] transition-all px-6 py-1 hover:bg-[#9FB0F9] rounded-lg shadow-sm"
      />
      <Link
        href={linkHref}
        className="text-white text-[14px] hover:text-[#F9F9F9] transition-all"
      >
        {linkSpan}
      </Link>
    </form>
  );
}
