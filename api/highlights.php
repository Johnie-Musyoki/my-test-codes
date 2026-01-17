<?php
header('Content-Type: application/json');

$features = [
    [
        'title' => 'Private Vault Storage',
        'description' => 'Secure vaults for jewelry, documents, collectibles, and high-value assets.'
    ],
    [
        'title' => 'Business & Institutional Storage',
        'description' => 'Compliant storage solutions for financial firms, estates, and corporate archives.'
    ],
    [
        'title' => 'Insured Logistics & Transport',
        'description' => 'White-glove pickup, delivery, and verified chain-of-custody services.'
    ]
];

$stats = [
    ['label' => 'Secure Vaults', 'value' => '9,400+'],
    ['label' => 'Assets Protected', 'value' => '$2.6B'],
    ['label' => 'Facilities Nationwide', 'value' => '18']
];

$testimonials = [
    [
        'name' => 'Carter Levine',
        'role' => 'Family Office Director',
        'quote' => 'SmartVaults feels like a private bank vault with concierge access.'
    ],
    [
        'name' => 'Rina Patel',
        'role' => 'Luxury Collector',
        'quote' => 'The onboarding process was seamless, and I trust the security team completely.'
    ]
];

$response = [
    'features' => $features,
    'stats' => $stats,
    'testimonials' => $testimonials
];

echo json_encode($response);
