<x-layout>
    <div class="terms-and-conditions-page container mx-auto mt-10">

        {{-- back to prev page button --}}
        <div class="flex mb-5">
            <x-back-button />
        </div>

        {{-- header --}}
        <x-page-header label='Terms & Conditions page' updatedClass='text-center' />

        {{-- disclaimer --}}
        <div class="text-center">
            <h3 class="font-bold text-lg">
                The following content is has been generate using AI
            </h3>
            <h3 class="font-bold text-lg">
                This is just for development purposes
            </h3>
        </div>

        {{-- content --}}
        <section class="max-w-4xl mx-auto px-4 py-12 text-gray-800">
            <p class="mb-4">
                By accessing or using ClassicCarsApp, you agree to these Terms & Conditions. Please read
                them carefully.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                1. User Accounts
            </h2>
            <p class="mb-4">
                You are responsible for maintaining the confidentiality of your login information and all
                activities under your account.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                2. Listings and Content
            </h2>
            <p class="mb-4">
                You retain ownership of your listings and content but allow us to display and share it
                through our platform.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                3. Prohibited Activities
            </h2>
            <ul class="list-disc list-inside mb-4">
                <li>Posting misleading or fraudulent listings</li>
                <li>Using the site for illegal purposes</li>
                <li>Accessing restricted areas without permission</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                4. Limitation of Liability
            </h2>
            <p class="mb-4">
                We are not responsible for any loss or damages resulting from use of the service. It is
                provided "as is."
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                5. Termination
            </h2>
            <p class="mb-4">
                We reserve the right to suspend or terminate accounts at any time for violations of these
                terms.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                6. Governing Law
            </h2>
            <p class="mb-4">
                These terms are governed by the laws of your local jurisdiction.
            </p>
        </section>

    </div>
</x-layout>