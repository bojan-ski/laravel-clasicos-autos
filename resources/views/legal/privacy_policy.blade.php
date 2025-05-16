<x-layout>
    <div class="privacy-policy-page container mx-auto mt-10">

        {{-- back to prev page button --}}
        <div class="flex mb-5">
            <x-back-button />
        </div>

        {{-- header --}}
        <x-page-header label='Privacy Policy page' updatedClass='text-center' />

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
        <div class="max-w-4xl mx-auto px-4 py-12 text-gray-800">

            <p class="mb-4">
                Welcome to ClassicCarsApp. We are committed to protecting your privacy and ensuring your personal
                information is handled securely and responsibly.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                1. Information We Collect
            </h2>
            <ul class="list-disc list-inside mb-4">
                <li>Personal information: name, email address, phone number, etc.</li>
                <li>Usage data: pages visited, time spent, clicks, etc.</li>
                <li>Cookies and tracking technologies.</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                2. How We Use Your Information
            </h2>
            <ul class="list-disc list-inside mb-4">
                <li>To provide and maintain our service</li>
                <li>To notify you about updates</li>
                <li>To personalize your experience</li>
                <li>For analytics and marketing</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                3. Sharing of Information
            </h2>
            <p class="mb-4">
                We do not sell or rent your personal information. Data may be shared only with trusted partners to
                support our services.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                4. Data Security
            </h2>
            <p class="mb-4">
                We use industry-standard security measures, but no system is 100% secure.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                5. Your Rights
            </h2>
            <p class="mb-4">
                You can access, update, or request deletion of your data. Contact us at
                support@classiccarsapp.com.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-2">
                6. Changes to This Policy
            </h2>
            <p class="mb-4">
                We may update this policy. Changes will be posted with the revision date.
            </p>
        </div>

    </div>
</x-layout>