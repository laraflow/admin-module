@extends('admin::layouts.auth')

@section('title', 'Login')

@push('meta')

@endpush

@push('webfont')

@endpush

@push('icon')

@endpush

@push('plugin-style')
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('modules/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@push('inline-style')

@endpush

@push('head-script')

@endpush

@section('body-class', 'login-page')

@section('content')
    <div class="container-xl">
        <div class="login-logo">
            <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card" style="height: 75vh; overflow-y: scroll;">
            <div class="card-body login-card-body">
                <div class="content-block pc_object">
                    <p>As the world’s most trusted antivirus software company, we aim to defend you against threats in
                        cyberspace. To do so, we may have to collect your personal data to provide you with the best
                        weapons and the most up-to-date security. We do not take your trust for granted so we’ve
                        developed a Privacy Policy that covers how we collect, use, disclose, transfer, and store your
                        personal data.</p>
                    <p>This Privacy Policy was last updated in June 2021.</p>
                </div>

                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="who-we-are">Who We Are</h2>
                    </div>
                    <p>This General Privacy Policy (“Privacy Policy”) applies to the Avast Group (collectively “we,”
                        “us” or “our”).</p>
                    <p>If you live in the <a href="https://en.wikipedia.org/wiki/European_Economic_Area" rel="nofollow"
                                             target="_blank">European Economic Area</a>, the Controller of your personal
                        data is Avast Software s.r.o., which has its principal place of business at 1737/1A Pikrtova,
                        Prague 4, Czech Republic, 140 00.</p>
                    <p>If you live in the United Kingdom, Avast’s representative established in the UK is AVG
                        Technologies UK Ltd.,110 High Holborn, 7th Floor, London, WC1V 6JS, England.</p>
                </div>

                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="privacy-policy">Privacy Policy Contents</h2>
                    </div>
                    <p>This Privacy Policy describes how we handle and protect your personal data and the choices
                        available to you regarding collection, process, access, and how to update, correct and delete
                        your personal data. Additional information on our personal data practices may be provided in
                        product settings, contractual terms, or notices provided prior to or at the time of data
                        collection.</p>
                    <p>Please refer to our <a href="/products-policy" target="_blank">Products Policy</a> describing
                        specifics of personal data processing within our products and services.</p>
                    <p>This Privacy Policy is intended for you if you are a user of our products and services. If you
                        are a business partner, the privacy notice that applies to you is located here: <a
                            href="/partner-privacy" target="_blank">Business partner policy</a>.</p>
                    <p><strong>Personal Data We Process</strong></p>
                    <p>Personal data refers to any information relating to an identified or identifiable natural person
                        (“Personal Data”). </p>
                    <p>We may collect data or ask you to provide certain data when you visit and use our websites,
                        products and services. The sources from which we collect Personal Data include: </p>
                    <ul>
                        <li>Data collected directly from you or your device relating to an identified or identifiable
                            natural person (“Data Subject”), and may include direct identifiers such as name, address,
                            email address, phone number, and online or indirect identifiers such as login account
                            number, login password, marketing preferences, social media account, or IP address;
                        </li>
                        <li>If we link other data relating to you with your Personal Data, we will treat that linked
                            data as Personal Data; and
                        </li>
                        <li>We may also collect Personal Data from trusted third-party sources such as distributors,
                            resellers, app stores, contact centers, and engage third parties such as marketing, survey,
                            analytics or software suppliers to collect Personal Data to assist us.
                        </li>
                    </ul>
                    <p>We do not process special categories of personal data or deduce in any way this type of
                        information from data we collect within our products. </p>
                    <p>We organize the Personal Data we process into these basic categories: Billing Data, Account Data,
                        and Product Data.</p>
                    <p><strong>Billing Data</strong> includes your name, email address, masked credit card number,
                        license information and in certain circumstances, your billing address and your phone number. In
                        most circumstances, you purchase our products and services from a trusted third-party service
                        provider, reseller, or app store. In those circumstances, your Billing Data is processed by the
                        relevant third party and we only receive a subset of this data to keep proper business records.
                        In these instances, see below an example of Billing Data and what we use it for:</p>
                    <table>
                        <tbody>
                        <tr>
                            <td><p><strong>Billing data</strong></p></td>
                            <td><p><strong>What we use it for</strong></p></td>
                        </tr>
                        <tr>
                            <td><p>Email address</p></td>
                            <td><p>To send you purchase receipts</p></td>
                        </tr>
                        <tr>
                            <td><p>Masked credit card number</p></td>
                            <td><p>To process the payment and billing records</p></td>
                        </tr>
                        <tr>
                            <td><p>License key</p></td>
                            <td><p>To identify a specific license for a follow-up actions such as renewal or
                                    troubleshooting</p></td>
                        </tr>
                        <tr>
                            <td><p>License type</p></td>
                            <td><p>To enable features based on the purchased license</p></td>
                        </tr>
                        <tr>
                            <td><p>Renewability</p></td>
                            <td><p>To check if a given subscription can be renewed</p></td>
                        </tr>
                        <tr>
                            <td><p>Date of expiry</p></td>
                            <td><p>To check whether a license is valid</p></td>
                        </tr>
                        </tbody>
                    </table>
                    <p><strong>Account Data</strong>&nbsp;includes information needed to set up and customize an
                        account, such as your name, email address and username, and information connected with our
                        services, such as license keys. For some of our products or some of their functions creating an
                        account is necessary. See below an example of Account Data and what we use it for:</p>
                    <table>
                        <tbody>
                        <tr>
                            <td><p><strong>Account data</strong></p></td>
                            <td><p><strong>What we use it for</strong></p></td>
                        </tr>
                        <tr>
                            <td><p>Name</p></td>
                            <td><p>To customize our communications by addressing you by your name</p></td>
                        </tr>
                        <tr>
                            <td><p>Email address</p></td>
                            <td><p>To send you communications regarding your license and support</p></td>
                        </tr>
                        <tr>
                            <td><p>Username</p></td>
                            <td><p>To manage your account and facilitate your login into the service</p></td>
                        </tr>
                        <tr>
                            <td><p>Subscription renewal date</p></td>
                            <td><p>To tell us until when the account is valid</p></td>
                        </tr>
                        <tr>
                            <td><p>Trial User</p></td>
                            <td><p>To add a trial period before the account is charged</p></td>
                        </tr>
                        </tbody>
                    </table>
                    <p>An account is also necessary for some features of our <strong>Forum. </strong>You have the option
                        to provide additional information within your account such as personal texts, disclose your
                        birth date, identify your gender, instant messaging number, messenger username, or website name
                        and address, disclose your physical location, and select an avatar or personalized picture. Any
                        information you provide here will be visible to other users (including your total number of
                        posts, and posts per day, the date and time you registered, your local time, and the date and
                        time of your last activity).</p>
                    <p><strong>Product Data</strong> includes two sub-categories: </p>
                    <ul>
                        <li><strong>Device Data</strong> includes information about the operating system; hardware;
                            city/country of device; error logs; browser; network; applications running on the device,
                            including the Avast products; and<strong> </strong></li>
                        <li><strong>Service Data</strong> includes information about the Avast product usage and events
                            relating to use of our product by you such as samples, detections and files used for malware
                            protection, information concerning URLs of websites, usage statistics (activation, crashes,
                            scans, errors), IP address.
                        </li>
                    </ul>
                    <p>These sub-categories differ for each product and service. If you want more detail about Device
                        and Service Data we process on a product basis, please refer to our <a href="/products-policy"
                                                                                               target="_blank">Products
                            Policy</a>.</p>
                </div>

                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="why-we-process">Why We Process Your Personal Data</h2>
                    </div>
                    <p>We use your Personal Data for the following purposes and on the following grounds:</p>
                    <p><strong>On the basis of fulfilling our contract</strong>&nbsp;with you or entering into a
                        contract with you on your request, in order to:</p>
                    <ul>
                        <li>Process purchase of our products or services from us, our partners or our trusted third-
                            party service providers’ online stores;
                        </li>
                        <li>Provision the download, activation, and performance of the product or service;</li>
                        <li>Keep our products or services up-to-date, safe and free of errors, including implementation
                            of new product features and versions;
                        </li>
                        <li>Verify your identity and entitlement to paid products or services, when you contact us for
                            support or access our services;
                        </li>
                        <li>Process your purchase transactions;</li>
                        <li>Update you on the status of your orders and licences;</li>
                        <li>Manage your subscriptions and user accounts; and</li>
                        <li>Provide you with technical and customer support.</li>
                    </ul>
                    <p><strong>On the basis of your consent</strong>, in order to:</p>
                    <ul>
                        <li>Subscribe you to a newsletter or the Avast forum;</li>
                        <li>Enable the provision of third-party ads in product messages;</li>
                        <li>Enable the provision of personalized ads in support of certain free products; and</li>
                        <li>Allow us to record our phone conversation when you contact our tech support by phone.</li>
                    </ul>
                    <p>We will always ask for your consent before any processing that requires it and provide you with
                        necessary information through our <a href="/consent-policy" rel="nofollow" target="_blank">Consent
                            Policy</a> or otherwise as applicable. </p>
                    <p><strong>On the basis of legal obligations</strong>,&nbsp;we process your Personal Data when it is
                        necessary for compliance with a legal tax, accounting, anti-money laundering, legal order,
                        sanction checks or other obligation to which we are subject.</p>
                    <p><strong>On the basis of our legitimate interest</strong>&nbsp;we will use your Personal Data to:
                    </p>
                    <ul>
                        <li>Communicate about possible security, privacy and performance improvements and products that
                            supplement or improve our purchased products and to optimize the content and delivery of
                            this type of communication;
                        </li>
                        <li>Evaluate and improve the performance and quality of our products, services and websites,
                            develop new products, train our employees and to understand usage trends, and analyze user
                            acquisitions, conversions and campaigns;
                        </li>
                        <li>Allow interoperability within our applications;</li>
                        <li>Secure our systems and applications;</li>
                        <li>Allow effective performance of our business by ensuring necessary internal administrative
                            and commercial processes (e.g. finances, controlling, business intelligence, legal &amp;
                            compliance, information security etc.); and
                        </li>
                        <li>Establish, exercise or defend our legal rights.</li>
                    </ul>
                    <p>For the above mentioned processing operations, we have balanced your interests against our
                        interests. In any case, you have the right to object, on grounds relating to our particular
                        situation, to those processing operations. For more details please see section <a
                            href="#privacy-rights">Your Privacy Rights</a>.</p>

                    <h2 id="interests">Balancing Legitimate Interests</h2>
                    <p>Before relying on our legitimate interests, we balanced them against your interests and made sure
                        they are compelling enough and will not cause any unwarranted harm. With respect to the purposes
                        below we consider necessary to explain what our interests are in detail.</p>

                    <h3 id="apps">Systems, Apps and Network Security</h3>
                    <p>We process Personal Data for network and information security purposes. In line with EU data
                        protection law, organizations have a recognized legitimate interest in collecting and processing
                        Personal Data to the extent strictly necessary and proportionate for the purposes of ensuring
                        network and information security. This primarily covers the ability of a network or of an
                        information system to resist events, attacks or unlawful or malicious actions that could
                        compromise the availability, authenticity, integrity and confidentiality of stored or
                        transmitted data, or the security of the related services offered by, or accessible via those
                        networks and systems.</p>
                    <p>Both as an organization in our own right, and as a provider of cybersecurity technologies and
                        services which may include hosted and managed cybersecurity technology services, it is necessary
                        for the functionality of our systems, products and services and in our legitimate interests as
                        well as in our users’, to collect and process Personal Data to the extent strictly necessary and
                        proportionate for the purposes of ensuring the security of our own, and of our users’ networks,
                        devices, and information systems. This includes the development of threat intelligence resources
                        aimed at maintaining and improving on an ongoing basis the ability of our networks and systems,
                        and those of certain partners, to resist unlawful or malicious actions and other harmful events
                        (“cyber-threats”).</p>
                    <p>The Personal Data we process for said purposes includes, without limitation, network traffic data
                        related to cyber-threats such as:</p>
                    <ul>
                        <li>Sender email addresses (e.g., of sources of&nbsp;SPAM);</li>
                        <li>Recipient email addresses (e.g., of victims of targeted email cyberattacks including&nbsp;phishing);</li>
                        <li>Reply-to email addresses (e.g., as configured by cybercriminals sending malicious email);
                        </li>
                        <li>Filenames and execution paths (e.g., of malicious or otherwise harmful executable files
                            attached to emails);
                        </li>
                        <li>URLs and associated page titles (e.g., of web pages broadcasting or hosting malicious or
                            otherwise harmful contents); and/or
                        </li>
                        <li>IP addresses (e.g., of web servers and connected devices involved in the generation,
                            distribution, conveyance, hosting, caching or other storage of cyber-threats such as
                            malicious or otherwise harmful contents).
                        </li>
                    </ul>
                    <p>Depending on the context in which such data is collected, it may contain Personal Data concerning
                        you or any other Data Subjects. However, in such cases, we will process the data concerned only
                        to the extent strictly necessary and proportionate to the purposes of detecting, blocking,
                        reporting (by removing any personally identifiable elements) and mitigating the cyber-threats of
                        concern to you, and to secure your network, device and systems. When processing Personal Data in
                        this context, we do not seek to identify a Data Subject.</p>

                    <h3 id="messages">In-product and Email Messages</h3>
                    <p>We have a legitimate interest for messaging our users about possible security, privacy and
                        performance improvements and products that supplement or improve purchased products.</p>
                    <p>If you are our customer, we feel a responsibility to inform you about security and utility
                        improvements and possible problems to your device and software that go beyond our product that
                        is installed and provide you with effective solutions relevant to these problems. We thus have
                        legitimate interest to optimize the content and delivery of this type of communication to you so
                        that you will be most likely to find them relevant and non-intrusive at the same time.</p>

                    <h3 id="improvement">Product and business improvement</h3>
                    <p>We have a legitimate interest to use necessary Personal Data to understand user conversions,
                        acquisitions and campaign performance through various distribution channels, and users’
                        download, activation and interactions with our products because these analytics help us improve
                        functionality, effectiveness, security and reliability of our products and business activities
                        and develop new products. This processing includes using third-party tools. Please refer to our
                        <a href="/products-policy" target="_blank">Products Policy</a> for the list of third-party tools
                        used for the specific products and services.</p>
                </div>

                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="how-we-process">How We Process Your Personal Data</h2>
                    </div>
                    <p>We do our best to disconnect or remove all direct identifiers from the Personal Data that we
                        use:</p>
                    <ul>
                        <li>For free versions, this disconnection or removal of identifiers begins when the products and
                            services are initially activated. For paid users we keep Billing Data in a separate database
                            and minimize its use for anything other than handling payments and our own finances.
                        </li>
                        <li>For both paid and free versions, we continuously monitor for, minimize, disconnect and
                            remove all direct identifiers during the normal performance of the products and services.
                        </li>
                    </ul>

                    <h2 id="processing">Processing of IP Addresses</h2>
                    <p>For paid products including antivirus, virtual private network (“VPN”), and performance, your IP
                        address is collected at the time at which your product or service is being provided, for the
                        purpose of facilitating our billing process. Specifically, our third-party billing partner will
                        collect your IP address for its billing process; we do not store the IP address from this
                        process.</p>
                    <p>For free and paid products including antivirus, your IP address is also processed for the purpose
                        of downloading certain products, product authorization, fraud and malware detection.</p>
                    <p>Please refer to our <a href="/products-policy" rel="nofollow" target="_blank">Products Policy</a>
                        for specific use of IP address by our products and services.</p>

                    <h2 id="profiling">Personalization</h2>
                    <p>We use your answers from surveys, in which you can participate, and relevant Product Data to
                        personalize communication and recommend our relevant products for you.</p>
                    <p>We do not take any decisions solely based on algorithms, including profiling, that would
                        significantly affect you.</p>
                </div>

                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="how-we-disclose">How We Disclose Your Personal Data</h2>
                    </div>
                    <p>We only disclose your Personal Data as described below, within our group, with our partners, with
                        service providers that process data on our behalf and with public authorities, as required by
                        applicable law. Processing is only undertaken for the purposes described in this Privacy Policy
                        and the relevant <a href="/products-policy" rel="nofollow" target="_blank">Products Policy</a>
                        sections. If we disclose your Personal Data, we require its recipients to comply with adequate
                        privacy and confidentiality requirements, and security standards.</p>

                    <h2 id="payment-processors">Payment processors</h2>
                    <p>If you opt to pay for use of our services, we will use a third party payment processor to take
                        payment from you. These third parties are properly regulated and authorized to handle your
                        payment information and are prohibited from using your Personal Data for any other purposes
                        other than arranging these services for us. However, they are independent controllers of your
                        data with their own responsibility.</p>
                    <p>These are our long-term payment processors:</p>
                    <table>
                        <tbody>
                        <tr>
                            <td><p><strong>Payment Processor</strong></p></td>
                            <td><p><strong>Link to Privacy Policy</strong></p></td>
                            <td><p><strong>Location</strong></p></td>
                        </tr>
                        <tr>
                            <td><p>Digital River</p></td>
                            <td><p><a href="https://www.digitalriver.com/privacy-policy/" rel="nofollow"
                                      target="_blank">https://www.digitalriver.com/privacy-policy/</a></p></td>
                            <td><p>US, Ireland</p></td>
                        </tr>
                        <tr>
                            <td><p>Softline</p></td>
                            <td><p>https://allsoftglobal.com/en/privacy-policy/ </p></td>
                            <td><p>Cyprus</p></td>
                        </tr>
                        <tr>
                            <td><p>Nexway</p></td>
                            <td><p><a href="https://www.nexway.com/legal-notice-privacy/" rel="nofollow"
                                      target="_blank">https://www.nexway.com/legal-notice-privacy/</a></p></td>
                            <td><p>Germany, France, USA</p></td>
                        </tr>
                        <tr>
                            <td><p>Cleverbridge</p></td>
                            <td><p><a href="https://www.cleverbridge.com/?scope=opprivacy" rel="nofollow"
                                      target="_blank">https://www.cleverbridge.com/?scope=opprivacy</a></p></td>
                            <td><p>Germany, USA, Japan, Taiwan, Malta</p></td>
                        </tr>
                        <tr>
                            <td><p>DLocal (only for non-EEA customers)</p></td>
                            <td><p><a href="https://dlocal.com/legal/privacy-policy/" rel="nofollow" target="_blank">https://dlocal.com/legal/privacy-policy/</a>
                                </p></td>
                            <td><p>US, UK, Malta</p></td>
                        </tr>
                        <tr>
                            <td><p>Net Distribution Services (only for non-EEA customers)</p></td>
                            <td><p>---</p></td>
                            <td><p>India</p></td>
                        </tr>
                        <tr>
                            <td><p>Paypal </p></td>
                            <td><p><a href="https://www.paypal.com/en/webapps/mpp/ua/privacy-full" rel="nofollow"
                                      target="_blank">https://www.paypal.com/en/webapps/mpp/ua/privacy-full</a></p></td>
                            <td><p>US, Ireland</p></td>
                        </tr>
                        <tr>
                            <td><p>Google Play Store (for mobile apps)</p></td>
                            <td><p><a href="https://policies.google.com/privacy" rel="nofollow" target="_blank">https://policies.google.com/privacy</a>
                                </p></td>
                            <td><p>US, Ireland</p></td>
                        </tr>
                        <tr>
                            <td><p>Apple Store (for mobile apps)</p></td>
                            <td><p><a href="https://www.apple.com/legal/privacy/" rel="nofollow" target="_blank">https://www.apple.com/legal/privacy/</a>
                                </p></td>
                            <td><p>US, Ireland</p></td>
                        </tr>
                        </tbody>
                    </table>
                    <p>Your Billing Data is processed by the payment processor from whom you purchased the product. Your
                        data is processed according to the relevant processor’s privacy policy. </p>

                    <h2 id="service-providers">Service Providers</h2>
                    <p>We may use contractors and service providers to process your Personal Data for the purposes
                        described in this Privacy Policy and <a href="/products-policy" rel="nofollow" target="_blank">Products
                            Policy</a>. We contractually require service providers to keep data secure and confidential.
                    </p>
                    <p>Such service providers may include in particular contact centers, professional consultants
                        (including for defence or exercise of our rights), and marketing/survey/analytics/software
                        suppliers.</p>
                    <p>Sometimes these service providers, for example, our distributors, resellers, and app store
                        partners, will be independent controllers of your data and their terms and conditions, end user
                        license agreements (“EULA”) and privacy statements will apply to such relationships.</p>

                    <h2 id="advertising-companies">Advertising Companies</h2>
                    <p>To be able to offer our products and services for free, we serve third-party ads of advertising
                        companies in our products for mobile devices. To enable the ad, we embed a software development
                        kit (“SDK”) provided by an advertising company into the product, which then collects Personal
                        Data in order to personalize ads for you. </p>
                    <p>Please note that only few of our free products serve third-party ads. You will be asked for
                        consent during the installation process of such product. For further information, including the
                        exact scope of processed Personal Data and names of relevant products, please refer to our <a
                            href="/consent-policy" rel="nofollow" target="_blank">Consent Policy</a> which includes the
                        list of our advertising partners and their privacy policy.</p>

                    <h2 id="distributors">Distributors, Resellers</h2>
                    <p>We may provide your Personal Data to our partners for the purpose of distribution, sale or
                        management of our products. Our partners may use your Personal Data to communicate with you and
                        others about Avast products or services. In addition, you purchase our products directly from
                        our distributor, a reseller, or an app store. Because your relationship in these cases is with
                        that distributor, reseller or an app store, such third party will also process your Personal
                        Data.</p>

                    <h2 id="cookies-roviders">Cookies Providers</h2>
                    <p>Our websites use cookies to personalize your experience on our sites, tell us which parts of our
                        websites people have visited, help us measure the effectiveness of campaigns, and give us
                        insights into user interactions and user base as a whole so we can improve our communications
                        and products.. While using our websites, you will be asked to authorize the collection and use
                        of data by cookies according to the terms of the <a href="/cookies-policy" rel="nofollow"
                                                                            target="_blank">Cookie Policy</a>.</p>

                    <h2 id="analytics-providers">Analytics Tool Providers</h2>
                    <p>We use analytical tools, including third-party analytical tools, which allow us to, among other
                        things, identify potential performance or security issues with our products, improve their
                        stability and function, understand how you use our products, and websites, so that we can
                        optimize and improve your user experience, as well as evaluate and improve our campaigns. We use
                        Service and Device data for analytics.</p>
                    <p>While we generally prefer using our own analytical tools, we sometimes need to partner with other
                        parties, which have developed and provide us with their own tools and expertise. Below, we list
                        these partners and tools and their privacy policies.</p>
                    <table>
                        <tbody>
                        <tr>
                            <td><p><strong>Tool (provider)</strong></p></td>
                            <td><p><strong>Type of Analytics</strong></p></td>
                            <td><p><strong>Link to Privacy Policy</strong></p></td>
                            <td><p><strong>Location</strong></p></td>
                        </tr>
                        <tr>
                            <td><p>Google Analytics (Google)</p></td>
                            <td>user behaviour</td>
                            <td><p><a href="https://support.google.com/analytics/answer/6004245" rel="nofollow"
                                      target="_blank">https://support.google.com/analytics/answer/6004245</a></p>
                                <p><a href="https://policies.google.com/privacy" rel="nofollow" target="_blank">https://policies.google.com/privacy</a>
                                </p>
                                <p><a href="https://support.google.com/analytics/answer/6366371?hl=en&ref_topic=2919631"
                                      rel="nofollow" target="_blank">https://support.google.com/analytics/answer/6366371?hl=en&ref_topic=2919631</a>
                                </p></td>
                            <td><p>US, Ireland</p></td>
                        </tr>
                        <tr>
                            <td><p>Firebase Analytics (Google)</p></td>
                            <td>user behaviour (advanced features like A/B testing, predictions)</td>
                            <td><p><a href="https://firebase.google.com/support/privacy/" rel="nofollow"
                                      target="_blank">https://firebase.google.com/support/privacy/</a></p>
                                <p><a href="https://policies.google.com/privacy" rel="nofollow" target="_blank">https://policies.google.com/privacy</a>
                                </p></td>
                            <td><p>US, Ireland</p></td>
                        </tr>
                        <tr>
                            <td><p>Firebase Crashlytics (Google)</p></td>
                            <td>crash reporting</td>
                            <td><p><a href="https://try.crashlytics.com/terms/privacy-policy.pdf" rel="nofollow"
                                      target="_blank">https://try.crashlytics.com/terms/privacy-policy.pdf</a></p>
                                <p><a href="https://policies.google.com/privacy" rel="nofollow" target="_blank">https://policies.google.com/privacy</a>
                                </p></td>
                            <td><p>US, Ireland</p></td>
                        </tr>
                        <tr>
                            <td><p>AppsFlyer (AppsFlyer)</p></td>
                            <td><p>user acquisition</p></td>
                            <td><p><a href="https://www.appsflyer.com/privacy-policy/" rel="nofollow" target="_blank">https://www.appsflyer.com/privacy-policy/</a>
                                </p></td>
                            <td><p>Germany</p></td>
                        </tr>
                        <tr>
                            <td><p>Adjust (Adjust)</p></td>
                            <td><p>user acquisition</p></td>
                            <td><p><a href="https://www.adjust.com/terms/privacy-policy/" rel="nofollow"
                                      target="_blank">https://www.adjust.com/terms/privacy-policy/</a></p></td>
                            <td><p>Germany</p></td>
                        </tr>
                        <tr>
                            <td><p>Facebook Analytics (Facebook)</p></td>
                            <td><p>user behaviour</p></td>
                            <td><p><a href="https://www.facebook.com/about/privacy" rel="nofollow" target="_blank">https://www.facebook.com/about/privacy</a>
                                </p>
                                <p><a href="https://developers.facebook.com/docs/analytics/overview" rel="nofollow"
                                      target="_blank">https://developers.facebook.com/docs/analytics/overview</a></p>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><p>HockeyApp (Microsoft)</p></td>
                            <td><p>crash reporting</p></td>
                            <td><p><a href="https://privacy.microsoft.com/en-us/PrivacyStatement" rel="nofollow"
                                      target="_blank">https://privacy.microsoft.com/en-us/PrivacyStatement</a></p></td>
                            <td><p>US, Ireland</p></td>
                        </tr>
                        <tr>
                            <td><p>Mixpanel (Mixpanel Inc.)</p></td>
                            <td><p>user behaviour</p></td>
                            <td><p><a href="https://mixpanel.com/legal/privacy-policy/" rel="nofollow" target="_blank">https://mixpanel.com/legal/privacy-policy/</a>
                                </p></td>
                            <td><p>US</p></td>
                        </tr>
                        <tr>
                            <td><p>Loggly (Solar Winds/Loggly)</p></td>
                            <td><p>server side logging - troubleshooting issues</p></td>
                            <td><p><a href="https://www.loggly.com/about/privacy-policy/" rel="nofollow"
                                      target="_blank">https://www.loggly.com/about/privacy-policy/</a></p></td>
                            <td><p>US</p></td>
                        </tr>
                        <tr>
                            <td><p>Amplitude (Amplitude)</p></td>
                            <td><p>user behaviour</p></td>
                            <td><p><a href="https://amplitude.com/privacy" rel="nofollow" target="_blank">https://amplitude.com/privacy</a>
                                </p></td>
                            <td><p>US</p></td>
                        </tr>
                        <tr>
                            <td><p>Kochava</p></td>
                            <td><p>user acquisition and behaviour</p></td>
                            <td><p><a href="https://www.kochava.com/support-privacy/" rel="nofollow" target="_blank">https://www.kochava.com/support-privacy/</a>
                                </p></td>
                            <td><p>US</p></td>
                        </tr>
                        <tr>
                            <td><p>VWO</p></td>
                            <td><p>user behaviour (A/B testing)</p></td>
                            <td><p><a href="https://vwo.com/privacy-policy/" rel="nofollow" target="_blank">https://vwo.com/privacy-policy/</a>
                                </p></td>
                            <td><p>India</p></td>
                        </tr>
                        </tbody>
                    </table>
                    <p>Please note that not all of our products use all of these third-party analytics tools. Analytics
                        tools that we use for diagnosing your product are necessary for service provision. You will find
                        relevant tools listed under each product in our <a href="/products-policy" rel="nofollow"
                                                                           target="_blank">Products Policy</a>.</p>

                    <h2 id="public-authorities">Public Authorities</h2>
                    <p>In certain instances, it may be necessary for us to disclose your Personal Data to public
                        authorities or as otherwise required by applicable law. No Personal Data will be disclosed to
                        any public authority except in response to:</p>
                    <ul>
                        <li>A subpoena, warrant or other process issued by a court or other public authority of
                            competent jurisdiction;
                        </li>
                        <li>A legal process having the same consequence as a court-issued request for data, in that if
                            we were to refuse to provide such data, it would be in breach of local law, and it or its
                            officers, executives or employees would be subject to liability for failing to honor such
                            legal process;
                        </li>
                        <li>Where such disclosure is necessary for us to enforce its legal rights pursuant to applicable
                            law; or
                        </li>
                        <li>A request for data with the purpose of identifying and/or preventing credit card fraud.</li>
                    </ul>

                    <h2 id="mergers">Mergers, Acquisitions and Corporate Restructurings</h2>
                    <p>Like any other company, we too go through its own cycle of growth, expansion, streamlining and
                        optimization. Its business decisions and market developments therefore affect its structure. As
                        a result of such transactions, and for maintaining a continued relationship with you, we may
                        transfer your Personal Data to a related affiliate.</p>
                    <p>If we are involved in a reorganization, merger, acquisition or sale of our assets, your Personal
                        Data may be transferred as part of that transaction. We will notify you of any such deal and
                        outline your choices in that event, when applicable.</p>

                    <h2 id="cross-border">Cross-Border Transfers of Personal Data among Avast Entities and to
                        Third-Party Vendors</h2>
                    <p>We are a global business that provides its products and services all around the world. In order
                        to reach all of our users and provide all of them with our software, we operate on an
                        infrastructure that spans the globe. The servers that are part of this infrastructure may
                        therefore be located in a country different than the one where you live. In some instances,
                        these may be countries outside of the European Economic Area (“EEA”). Regardless, we provide the
                        same GDPR-level of protection to all Personal Data it processes.</p>
                    <p>At the same time, when we transfer Personal Data outside of the EEA, we always make sure to put
                        in place appropriate and suitable safeguards, such as standardized contracts approved by the
                        European Commission, and to ensure that your data remains safe and secure at all times and that
                        your rights are protected.</p>
                    <p>Situations where we transfer Personal Data outside of the EEA include provision of our products
                        and services, processing of transactions and your payment details, and the provision of support
                        services. Further, an outside-EEA transfer may also occur in case of a merger, acquisition or a
                        restructuring, where the acquirer is located outside of the EEA (see the <a href="#mergers">Mergers,
                            Acquisitions and Restructurings</a> section).</p>
                </div>

                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="how-we-protect">How We Protect Your Personal Data</h2>
                    </div>
                    <p>We maintain administrative, technical, and physical safeguards for the protection of your
                        Personal Data.</p>

                    <h2 id="administrative-safeguards">Administrative Safeguards</h2>
                    <p>Access to the Personal Data of our users is limited to authorized personnel who have a legitimate
                        need to know based on their job descriptions, for example, employees who provide technical
                        support to end users, or who service user accounts. In the case of third-party contractors who
                        process personal information on our behalf, similar requirements are imposed. These third
                        parties are contractually bound by confidentiality clauses, even when they leave. Where an
                        individual employee no longer requires access, that individual's credentials are revoked.</p>

                    <h2 id="technical-safeguards">Technical Safeguards</h2>
                    <p>We store your personal information in our database using the protections described above. In
                        addition, we utilize up-to-date&nbsp;<a href="/f-firewall" rel="nofollow" target="_blank">firewall</a>
                        protection for an additional layer of security. We use high-quality antivirus and&nbsp;<a
                            href="/c-malware" rel="nofollow" target="_blank">anti-malware</a> software, and regularly
                        update our&nbsp;<a href="/c-computer-virus" rel="nofollow" target="_blank">virus</a>
                        definitions. Third parties who we hire to provide services and who have access to our users'
                        data are required to implement privacy and security practices that we deem adequate.</p>

                    <h2 id="physical-safeguards">Physical Safeguards</h2>
                    <p>Access to user information in our database by Internet requires using an encrypted VPN, except
                        for email which requires user authentication. Otherwise, access is limited to our physical
                        premises. Physical removal of Personal Data from our location is forbidden. Third-party
                        contractors who process Personal Data on our behalf agree to provide reasonable physical
                        safeguards.</p>

                    <h2 id="proportionality">Proportionality</h2>
                    <p>We strive to collect no more Personal Data from you than is required by the purpose for which we
                        collect it. This, in turn, helps reduce the total risk of harm should data loss or a breach in
                        security occur: the less data we collect, the smaller the overall risk.</p>
                </div>

                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="childrens-privacy">Children’s Privacy</h2>
                    </div>
                    <p>We have products and services designed specifically to assist you as a parent by providing child
                        online protection features. In such cases, we will only collect and process Personal Data
                        related to any child under 13 years of age, which you choose to disclose to us or otherwise
                        instruct us to collect and process. Details about this processing is included in our <a
                            href="/products-policy" rel="nofollow" target="_blank">Products Policy</a>. Please refer to
                        the specific applicable notices for this information.</p>
                </div>


                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="how-long-we-store">How Long We Store Your Personal Data</h2>
                    </div>
                    <p>We will hold your Personal Data on our systems for the following periods: </p>
                    <ul>
                        <li>For Billing Data, for as long as we have a legal obligation or for our legitimate interests
                            in establishing legal rights;
                        </li>
                        <li>For Account Data, for as long as you maintain your account;</li>
                        <li>For Product Data, only as long as necessary for the purposes of a particular product or
                            service. We use rolling deletion periods which means we regularly delete collected data in
                            the given periods starting from the collection of that respective data. The rolling deletion
                            periods for Product Data are not longer than six years. You can find specific rolling
                            deletion periods for each of our products and their purposes in our <a
                                href="/products-policy" rel="nofollow" target="_blank">Products Policy</a>. Please note
                            that when you uninstall our product, processing for service provision, in-product messaging,
                            analytics and third-party ads, if applicable, dependent on the installed product shall
                            cease. After the uninstallation, we will continue to process your Product Data for
                            statistical purposes for up to six years, however, we have appropriate measures in place,
                            including pseudonymization.
                        </li>
                    </ul>
                </div>


                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="storage-of-personal-data">Storage of Your Personal Data</h2>
                    </div>
                    <p>The data we collect from you may be stored, with risk-appropriate technical and organizational
                        security measures applied to it, on in-house as well as third-party servers in the Czech
                        Republic, in the United States, as well as anywhere we or our trusted service providers and
                        partners operate. </p>
                    <p>In all cases, we follow generally accepted standards and security measures to protect the
                        personal data submitted to us, both during transmission and once we receive it. </p>
                </div>


                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="privacy-rights">Your Privacy Rights</h2>
                    </div>
                    <p>You have the following rights regarding the processing of your Personal Data:</p>
                    <ul>
                        <li>Right to information - Right to receive information about the processing of your Personal
                            Data, prior to processing as well as during the processing, upon request.
                        </li>
                        <li>Right of access - Aside from the information about the processing of your Personal Data, you
                            have the right to receive a copy of your Personal Data undergoing processing.
                        </li>
                        <li>Right to rectification - We should process accurate Personal Data; if you discover
                            inaccuracy, you have the right to seek rectification of inaccurate Personal Data.
                        </li>
                        <li>Right to erasure ("right to be forgotten") - You have the right to erasure of your Personal
                            Data, but only in specific cases stipulated by law, e.g., if there is no legally recognized
                            title on our part for further processing of your Personal Data (incl. protection of Avast’s
                            legitimate interests and rights).
                        </li>
                        <li>Right to data portability - The right to receive Personal Data which you have provided and
                            is being processed on the basis of consent or where it is necessary for the purpose of
                            conclusion and performance of a contract, in machine-readable format. This right applies
                            exclusively to Personal Data which processing is carried out by automated means.
                        </li>
                        <li>Right to object - Applies to cases of processing carried out in legitimate interest. You
                            have the right to object to such processing, on grounds relating to your particular
                            situation, and we are required to assess the processing in order to ensure compliance with
                            all legally binding rules and applicable regulations. In case of direct marketing, we shall
                            cease processing Personal Data for such purposes after the objection.
                        </li>
                        <li>Right to withdraw consent - In the case of processing based on your consent, as specified in
                            our <a href="/consent-policy" rel="nofollow" target="_blank">Consent Policy</a>, you can
                            withdraw your consent at any time, by using the same method (if technically possible) you
                            used to provide it to us (the exact method will be described in more detail with each
                            consent when you provide it). The withdrawal of consent shall not affect the lawfulness of
                            processing based on your consent before its withdrawal.
                        </li>
                        <li>Right to restriction of processing - You have the right to restriction of processing of your
                            Personal Data if: You are contesting the accuracy of your Personal Data, for a period
                            enabling us to verify the accuracy of your Personal Data; the processing is unlawful and you
                            oppose the erasure of the Personal Data and request the restriction of its use instead; we
                            no longer need the Personal Data for the purposes of the processing, but they are required
                            by you for the establishment, exercise or defence of legal claims; or you have objected to
                            processing of your Personal Data, and there is a pending verification whether our legitimate
                            grounds override your interests.
                        </li>
                        <li>Right to contact supervisory authority, court - You may contact and lodge a complaint with
                            the supervisory authority – The Office for Personal Data Protection (Czech: Úřad na ochranu
                            osobních údajů – www.uoou.cz) or your local authority or a relevant court.
                        </li>
                    </ul>
                    <p>The fulfillment of data subject rights listed above will depend on the category of Personal Data
                        and the processing activity. In all cases, we strive to fulfill your request.</p>
                    <p>We will action your request within one month of receiving a request from you concerning any one
                        of your rights as a Data Subject. Should we be inundated with requests or particularly
                        complicated requests, the time limit may be extended to a maximum of another two months. If we
                        fail to meet these deadlines, we would, of course, prefer that you contact us to resolve the
                        situation informally.</p>
                    <p>Where requests we receive are manifestly unfounded or excessive, in particular because of their
                        repetitive character, we may either: (a) charge a reasonable fee taking into account the
                        administrative costs of providing the information or communication or taking the action
                        requested; or (b) refuse to act on the request.</p>
                    <p>For the free versions, we do not and will not maintain, acquire or process additional information
                        solely in order to identify the users of our free products and services. This is simply not
                        necessary for the free versions of our products to be provided to you and function. </p>
                    <p>This means, when you use a free version of our products and services, you may contact us with a
                        request concerning your Personal Data. Please note, consistent with our privacy by design,
                        privacy by default and minimization practices, we may not be able to identify you in connection
                        with your Product Data about your specific free products and services. If such a situation
                        occurs, please go to your product settings and explore your options.</p>

                    <h2 id="your-choices">Your Choices in products</h2>
                    <p>You can make certain choices about how your data is used by us by adjusting the privacy settings
                        of the relevant product. Please check your product settings to set your privacy preferences
                        there.</p>

                    <h2 id="privacy-portal">Privacy Portal</h2>
                    <p>In order to make it easier for you to reach out to us and obtain the necessary information and
                        action changes, corrections or deletions of your Personal Data, we have decided to provide you
                        with a portal, which can show you the Billing Data and Account Data we have collected from you
                        as well as your email preferences. </p>
                </div>


                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="non-eu">Non-EU Jurisdictions</h2>
                    </div>

                    <h2 id="russian-residents">Residents of the Russian Federation</h2>
                    <p>We collect and process Personal Data on the territory of the Russian Federation in strict
                        compliance with the applicable laws of the Russian Federation.</p>
                    <p>We collect and process Personal Data (including sharing it with third parties) only upon the
                        consent of the respective individuals, unless otherwise is provided for by the laws of the
                        Russian Federation. You will be asked to grant your consent by ticking the respective box / or
                        clicking “I accept” button or through similar mechanism prior to having access to the site,
                        and/or when submitting or sharing the Personal Data we may request. We collect and use your
                        Personal Data only in the context of the purposes indicated in the consent to processing of
                        Personal Data.</p>
                    <p>We (directly or through third-party contractors specifically authorized by us) collect, record,
                        systematize, accumulate, store, actualize (update and amend), extract Personal Data of the
                        Russian Federation citizens with the use of databases located on the territory of the Russian
                        Federation, except as otherwise permitted by Russian data protection legislation. We may process
                        Personal Data of Russian citizens using databases located outside of the Russian Federation
                        subject to compliance with Russian data protection legislation.</p>
                    <p>We undertake all the actions necessary to ensure security of your Personal Data.</p>
                    <p>You are legally entitled to receive information related to processing your Personal Data. To
                        exercise this right, you have to submit a request to contacts indicated below in the Contact Us
                        section.</p>
                    <p>You have the right to revoke the consent at any time by sending us an e-mail at contacts
                        indicated below in the Contact Us section. Once we receive the revocation notice from you we
                        will stop processing and destroy your Personal Data, except as necessary to provision the
                        contract or service to you. However, please note once you have revoked your consent, we may not
                        be able to provide to you the products and services you request, and may not be able to ensure
                        proper work of our products.</p>
                    <p>We do not transfer your Personal Data to the countries that under Russian law are not deemed to
                        provide adequate protection to the individuals’ rights in the area of data privacy.</p>
                    <p>We do not offer, sell or otherwise make available our products or services that have access to,
                        collect and process (or allow us to do the same) Personal Data of third parties in the Russian
                        Federation without the consent of such third parties.</p>
                    <p>If any provisions of this Policy contradict the provisions of this section, the provisions of
                        this section shall prevail.</p>

                    <h2 id="california-privacy-rights">California Privacy Rights</h2>
                    <p>This section applies to California, USA residents: </p>

                    <h3 id="information-notice">Information Notice</h3>
                    <p><strong>Categories of collected personal information </strong></p>
                    <p>You can see all categories of collected personal information listed in the section Personal Data
                        We Process.</p>
                    <p><strong>Sources from which the personal information is collected</strong></p>
                    <p>You can find information about the sources of data in the section Personal Data We Process.</p>
                    <p><strong>Business or commercial purpose for collecting or selling personal information</strong>
                    </p>
                    <p>You can find all purposes of processing your personal information listed in the section Why We
                        Process Your Personal Data.</p>
                    <p><strong>Categories of third parties with whom the business shares personal information</strong>
                    </p>
                    <p>You can find all categories of recipients of personal information listed in the section How We
                        Diclose Your Personal Data. Avast does not and will not sell (as such term is defined in the
                        California Consumer Privacy Act) your personal information we collect without providing a right
                        to opt out or your direct permission. See more about your right to opt out of sale below.</p>
                    <p>Our products are not targeted at minors under 16 years of age. We therefore have no knowledge of
                        any sale of data concerning them.</p>

                    <h3 id="your-rights">Your Rights</h3>
                    <p>You have the right to:</p>
                    <ul>
                        <li>know what personal information is being collected about you;</li>
                        <li>know whether your personal information is sold or disclosed and to whom;</li>
                        <li>say no to the sale of personal information (right to opt out);</li>
                        <li>request deletion of your personal information; information will be deleted if no exception
                            applies (including our right to defend our lawful interests);
                        </li>
                        <li>access your personal information; specific information shall be provided in a portable and,
                            to the extent technically feasible, in a readily useable format but not more than twice in a
                            12-month period;
                        </li>
                        <li>equal service and price, even if you exercise your privacy rights (right to
                            non-discrimination).
                        </li>
                    </ul>
                    <p>Under California Civil Code § 1798.83, we are required to disclose to consumers the following
                        information upon written request: (1) the categories of personal information that we have
                        disclosed to third parties within the prior year, if that information was subsequently used for
                        marketing purposes; and (2) the names and addresses of all such third parties to whom such
                        personal information was disclosed. </p>
                    <p>We hereby disclose that we have not disclosed any such personal information as defined by the
                        California Civil Code § 1798.83 regarding any California resident during the one-year period
                        prior to the effective date of this Privacy Policy with the exception of:</p>
                    <ul>
                        <li>third-party advertising cookies stated in our <a href="/cookies-policy" rel="nofollow"
                                                                             target="_blank">Cookie Policy</a>.
                        </li>
                        <li>third-party ads in products listed in our <a href="/consent-policy" rel="nofollow"
                                                                         target="_blank">Consent Policy</a>.
                        </li>
                    </ul>

                    <h3 id="out-of-sale">Right To Opt Out Of Sale</h3>
                    <p>If your personal information is subject to a sale you have the right to opt out from that
                        sale. </p>
                    <p>A few of our free products serve third-party ads. You will be asked for consent during the
                        installation process of such a product. For further information, including the exact scope of
                        processed Personal Data and names of relevant products, please refer to our <a
                            href="/consent-policy" rel="nofollow" target="_blank">Consent Policy</a> which includes the
                        list of our advertising partners and their privacy policy. You can opt out from this processing
                        by upgrading to a paid version of the same product or by uninstalling the product. </p>
                    <p>Please note that we do use third-party cookies for our advertising purposes as further described
                        in our <a href="/cookies-policy" rel="nofollow" target="_blank">Cookie Policy</a> where you can
                        also find instructions on how to opt out of these cookies.</p>
                    <p>We will respect your decision to opt out for at least 12 months before asking you again to
                        authorize the sale of your personal information.</p>

                    <h3 id="request-submission">Request Submission</h3>
                    <p>You can submit your requests using contacts indicated below in the Contact Us section. If you are
                        a California resident under the age of 18, you may be permitted to request the removal of
                        certain content that you have posted on our websites. We will verify your request by matching
                        your email address and, if necessary, other information you provide in your request against the
                        email address and other information we have in our system. You can also designate an authorized
                        agent to exercise these rights on your behalf. We may require that you provide the authorized
                        agent with written permission to act on your behalf and that the authorized agent verify their
                        identity directly with us.</p>
                </div>


                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="contact-us">Contact Us</h2>
                    </div>
                    <p>To exercise any of your rights, or if you have any other questions or complaints about our use of
                        your Personal Data and its privacy, write our Privacy Team through the most convenient channel
                        below:</p>
                    <p>We are registered as Avast Software s.r.o. and our registered address is Pikrtova 1737/1a, 140 00
                        Prague 4, Nusle, Postal Code 140 00, Czech Republic. You can always reach us by email at&nbsp;<a
                            href="mailto:customerservice@avast.com" rel="nofollow" target="_blank">customerservice@avast.com</a>.
                        Please type “PRIVACY REQUEST” in the message line of your email so we can have the appropriate
                        member of the Avast team respond.</p>
                    <p>If you prefer, you can send paper mail to AVAST Software s.r.o., Pikrtova 1737/1a, 140 00 Prague
                        4, Czech Republic. Be sure to write "Attention: PRIVACY" in the address so we know where to
                        direct your correspondence.</p>
                    <p>If you live in the United Kingdom, you can contact our representative AVG Technologies UK Ltd.,
                        110 High Holborn, 7th Floor, London, WC1V 6JS, England.</p>
                    <p>If you have an unresolved privacy or data use concern that we have not addressed satisfactorily,
                        please contact our U.S.-based third party dispute resolution provider (free of charge) at <a
                            href="https://feedback-form.truste.com/watchdog/request" rel="nofollow" target="_blank">https://feedback-form.truste.com/watchdog/request</a>.
                    </p>
                </div>


                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="data-protection">Data Protection Officer</h2>
                    </div>
                    <p>As required under the GDPR, we have a data protection officer (DPO) to monitor our compliance
                        with the GDPR, provide advice where requested and cooperate with supervisory authorities. You
                        can contact our data protection officer via <a href="mailto:dpo@avast.com" rel="nofollow"
                                                                       target="_blank">dpo@avast.com</a>.</p>
                </div>


                <div class="content-block pc_object">
                    <div class="content_h2">
                        <img src="https://static3.avast.com/10002017/web/i/legal/arrow_up.svg" alt=""
                             class="text_arrow expanded">
                        <h2 id="changes">Changes to this Privacy Policy</h2>
                    </div>
                    <p>We reserve the right to revise or modify this Privacy Policy. In addition, we may update this
                        Privacy Policy to reflect changes to our data practices. If we make any material changes we will
                        notify you by email (sent to the e-mail address specified in your account) or by means of a
                        notice on this website prior to the change becoming effective. We encourage you to periodically
                        review this page for the latest information on our privacy practices.</p>
                </div>


            </div>
        </div>
    </div>
@endsection


@push('plugin-script')
    <script src="{{ asset('modules/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush

@push('page-script')
    <script type="text/javascript">
    </script>
@endpush
