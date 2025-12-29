<x-front-layout title="Payment">
  <div class="container py-5">
    <div class="card p-4">
      <form id="payment-form">
        <div id="payment-element">
          <!--Stripe.js injects the Payment Element-->
        </div>
        <button id="submit" class="btn btn-primary mt-3">
          <div class="spinner hidden" id="spinner"></div>
          <span id="button-text">Pay now</span>
        </button>
        <div id="payment-message" class="hidden"></div>
      </form>
    </div>

  </div>
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    // This is your test publishable API key.
    const stripe = Stripe("{{ config('services.stripe.STRIPE_PUBLISHABLE_KEY') }}");

    // The items the customer wants to buy
    // const items = [{ id: "xl-tshirt", amount: 1000 }];

    let elements;

    initialize();

    document
      .querySelector("#payment-form")
      .addEventListener("submit", handleSubmit);

    // Fetches a payment intent and captures the client secret
    async function initialize() {
      const { clientSecret } = await fetch("{{ route('order.payment.stripe.intent', $order->id) }}", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
      }).then((r) => r.json());

      elements = stripe.elements({ clientSecret });

      const paymentElementOptions = {
        layout: "accordion",
      };

      const paymentElement = elements.create("payment", paymentElementOptions);
      paymentElement.mount("#payment-element");
    }

    async function handleSubmit(e) {
      e.preventDefault();
      setLoading(true);

      const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
          // Make sure to change this to your payment completion page
          return_url: "{{ route('stripe.return', $order->id) }}",
        },
      });

      // This point will only be reached if there is an immediate error when
      // confirming the payment. Otherwise, your customer will be redirected to
      // your `return_url`. For some payment methods like iDEAL, your customer will
      // be redirected to an intermediate site first to authorize the payment, then
      // redirected to the `return_url`.
      if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
      } else {
        showMessage("An unexpected error occurred.");
      }

      setLoading(false);
    }

    // ------- UI helpers -------

    function showMessage(messageText) {
      const messageContainer = document.querySelector("#payment-message");

      messageContainer.classList.remove("hidden");
      messageContainer.textContent = messageText;

      setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageContainer.textContent = "";
      }, 4000);
    }

    // Show a spinner on payment submission
    function setLoading(isLoading) {
      if (isLoading) {
        // Disable the button and show a spinner
        document.querySelector("#submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
      } else {
        document.querySelector("#submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
      }
    }
  </script>
</x-front-layout>