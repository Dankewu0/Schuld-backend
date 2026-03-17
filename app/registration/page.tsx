import SubmitForm from "../_components/SubmitForm";
export default function Registration() {
  return (
    <div className="flex min-h-screen items-center justify-center font-sans dark:bg-black">
      <SubmitForm
        titleSpan="Регистрация"
        linkSpan="Уже есть аккаунт?"
        linkHref="/"
        buttonTitle="Зарегистрироваться"
        showEmail={true}
      />
    </div>
  );
}
